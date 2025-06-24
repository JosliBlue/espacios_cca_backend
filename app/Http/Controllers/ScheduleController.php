<?php

namespace App\Http\Controllers;

use App\Models\SpaceReservation;
use App\Models\Workshop;
use App\Models\WorkshopSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    private function getDayInSpanish($date)
    {
        $days = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];
        return $days[$date->format('l')];
    }

    public function getOccupiedSchedules(Request $request, $placeId)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $reservations = SpaceReservation::where('location_id', $placeId)
            ->whereBetween('date', [$start, $end])
            ->whereIn('status', [SpaceReservation::STATUS_APPROVED, SpaceReservation::STATUS_PENDING])
            ->select(
                'id',
                'name',
                'date',
                'start_time',
                'end_time',
                'status',
                DB::raw("'space_reservation' as type")
            )
            ->get()
            ->map(function ($reservation) {
                return [
                    'id' => $reservation->id,
                    'name' => $reservation->name,
                    'date' => Carbon::parse((string) $reservation->date)->format('Y-m-d'),
                    'start_time' => $reservation->start_time->format('H:i'),
                    'end_time' => $reservation->end_time->format('H:i'),
                    'status' => $reservation->status,
                    'type' => $reservation->type,
                ];
            });

        // Get workshop schedules
        $workshopSchedules = [];
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dayOfWeek = $this->getDayInSpanish($date);

            $schedules = WorkshopSchedule::join('workshops', 'workshop_schedules.workshop_id', '=', 'workshops.id')
                ->where('workshops.location_id', $placeId)
                ->where('workshop_schedules.day_of_week', $dayOfWeek)
                ->select(
                    'workshops.id',
                    'workshops.name as name',
                    'workshop_schedules.start_time',
                    'workshop_schedules.end_time'
                )
                ->get();

            foreach ($schedules as $schedule) {
                $workshopSchedules[] = [
                    'id' => $schedule->id,
                    'name' => $schedule->name,
                    'date' => $date->format('Y-m-d'),
                    'start' => $schedule->start_time->format('H:i'),
                    'end' => $schedule->end_time->format('H:i'),
                    'type' => 'workshop',
                ];
            }
        }

        return response()->json([
            'reservations' => $reservations,
            'workshops' => $workshopSchedules,
        ]);
    }

    public function checkAvailability(Request $request, $placeId)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'startTime' => 'required|date_format:H:i:s',
            'endTime' => 'required|date_format:H:i:s',
            'excludeReservationId' => 'nullable|integer|exists:space_reservations,id',
            'excludeWorkshopId' => 'nullable|integer|exists:workshops,id'
        ]);

        $date = $request->input('date');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $excludeReservationId = $request->input('excludeReservationId');
        $excludeWorkshopId = $request->input('excludeWorkshopId');

        // Check space reservations
        $reservationQuery = SpaceReservation::where('location_id', $placeId)
            ->where('date', $date)
            ->whereIn('status', [SpaceReservation::STATUS_APPROVED, SpaceReservation::STATUS_PENDING]);

        // Exclude specific reservation if provided
        if ($excludeReservationId) {
            $reservationQuery->where('id', '!=', $excludeReservationId);
        }

        $hasReservation = $reservationQuery->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime) {
                    $q->where('start_time', '<=', $startTime)
                        ->where('end_time', '>', $startTime);
                })->orWhere(function ($q) use ($endTime) {
                    $q->where('start_time', '<', $endTime)
                        ->where('end_time', '>=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '>=', $startTime)
                        ->where('end_time', '<=', $endTime);
                });
            })
            ->exists();

        if ($hasReservation) {
            return response()->json(['available' => false]);
        }

        // Check workshop schedules
        $dayOfWeek = $this->getDayInSpanish(Carbon::createFromFormat('Y-m-d', $date));
        $workshopQuery = WorkshopSchedule::join('workshops', 'workshop_schedules.workshop_id', '=', 'workshops.id')
            ->where('workshops.location_id', $placeId)
            ->where('workshop_schedules.day_of_week', $dayOfWeek);

        // Exclude specific workshop if provided
        if ($excludeWorkshopId) {
            $workshopQuery->where('workshops.id', '!=', $excludeWorkshopId);
        }

        $hasWorkshop = $workshopQuery->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime) {
                    $q->where('workshop_schedules.start_time', '<=', $startTime)
                        ->where('workshop_schedules.end_time', '>', $startTime);
                })->orWhere(function ($q) use ($endTime) {
                    $q->where('workshop_schedules.start_time', '<', $endTime)
                        ->where('workshop_schedules.end_time', '>=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('workshop_schedules.start_time', '>=', $startTime)
                        ->where('workshop_schedules.end_time', '<=', $endTime);
                });
            })
            ->exists();

        return response()->json(['available' => ! $hasWorkshop]);
    }

    public function rejectReservation($reservationId)
    {
        try {
            $reservation = SpaceReservation::findOrFail($reservationId);

            $reservation->status = SpaceReservation::STATUS_REJECTED;
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Reserva rechazada exitosamente',
                'data' => [
                    'id' => $reservation->id,
                    'name' => $reservation->name,
                    'status' => $reservation->status
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al rechazar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
