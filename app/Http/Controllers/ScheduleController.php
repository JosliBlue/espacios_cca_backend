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
            'Wednesday' => 'Miercoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sabado',
            'Sunday' => 'Domingo'
        ];
        return $days[$date->format('l')];
    }

    public function getOccupiedSchedules(Request $request, $placeId)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        // Get space reservations
        $reservations = SpaceReservation::where('location_id', $placeId)
            ->whereBetween('date', [$start, $end])
            ->select(
                'id',
                'name as title',
                DB::raw("CONCAT(date, 'T', start_time) as start"),
                DB::raw("CONCAT(date, 'T', end_time) as end"),
                DB::raw("'space_reservation' as type")
            )
            ->get();

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
                    'workshops.name as title',
                    'workshop_schedules.start_time',
                    'workshop_schedules.end_time'
                )
                ->get();

            foreach ($schedules as $schedule) {
                $workshopSchedules[] = [
                    'id' => 'w'.$schedule->id,
                    'title' => 'Taller: '.$schedule->title,
                    'date' => $date->format('Y-m-d'),
                    'start' => $schedule->start_time,
                    'end' => $schedule->end_time,
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
            'endTime' => 'required|date_format:H:i:s'
        ]);

        $date = $request->input('date');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');

        // Check space reservations
        $hasReservation = SpaceReservation::where('location_id', $placeId)
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
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
        $hasWorkshop = WorkshopSchedule::join('workshops', 'workshop_schedules.workshop_id', '=', 'workshops.id')
            ->where('workshops.location_id', $placeId)
            ->where('workshop_schedules.day_of_week', $dayOfWeek)
            ->where(function ($query) use ($startTime, $endTime) {
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
}
