<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\WorkshopSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class WorkshopController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $workshops = Workshop::with(['instructor', 'location', 'category', 'schedules'])->get();

            return response()->json([
                'status' => true,
                'workshops' => $workshops->map(function ($workshop) {
                    return [
                        'id' => $workshop->id,
                        'name' => $workshop->name,
                        'monthly_cost' => $workshop->monthly_cost,
                        'age_range' => $workshop->age_range,
                        'instructor' => $workshop->instructor,
                        'location' => $workshop->location,
                        'category' => $workshop->category,
                        'workshop_schedules' => $workshop->schedules
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting workshops',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'monthly_cost' => 'required|numeric',
            'age_range' => 'required|string|max:50',
            'instructor_id' => 'required|exists:instructors,id',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'schedules' => 'required|array|min:1',
            'schedules.*.day_of_week' => 'required|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'schedules.*.start_time' => 'required|date_format:H:i:s',
            'schedules.*.end_time' => 'required|date_format:H:i:s|after:schedules.*.start_time'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Validate schedule availability before creating
            foreach ($request->schedules as $schedule) {
                $availability = $this->checkScheduleAvailability(
                    $request->location_id,
                    $schedule['day_of_week'],
                    $schedule['start_time'] . ':00',
                    $schedule['end_time'] . ':00'
                );

                if (!$availability) {
                    throw new \Exception("El horario {$schedule['day_of_week']} de {$schedule['start_time']} a {$schedule['end_time']} no está disponible");
                }
            }

            // Create workshop
            $workshopData = $request->except('schedules');
            $workshop = Workshop::create($workshopData);

            // Create schedules
            foreach ($request->schedules as $schedule) {
                WorkshopSchedule::create([
                    'workshop_id' => $workshop->id,
                    'day_of_week' => $schedule['day_of_week'],
                    'start_time' => $schedule['start_time'],
                    'end_time' => $schedule['end_time']
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Workshop created successfully',
                'workshop' => $workshop->load(['instructor', 'location', 'category', 'schedules'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error creating workshop',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $workshop = Workshop::with(['instructor', 'location', 'category', 'schedules'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'workshop' => [
                    'id' => $workshop->id,
                    'name' => $workshop->name,
                    'monthly_cost' => $workshop->monthly_cost,
                    'age_range' => $workshop->age_range,
                    'instructor' => $workshop->instructor,
                    'location' => $workshop->location,
                    'category' => $workshop->category,
                    'workshop_schedules' => $workshop->schedules
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Workshop not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'monthly_cost' => 'required|numeric',
            'age_range' => 'required|string|max:50',
            'instructor_id' => 'required|exists:instructors,id',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'schedules' => 'nullable|array',
            'schedules.*.day_of_week' => 'required_with:schedules|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'schedules.*.start_time' => 'required_with:schedules|date_format:H:i:s',
            'schedules.*.end_time' => 'required_with:schedules|date_format:H:i:s|after:schedules.*.start_time'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $workshop = Workshop::findOrFail($id);

            DB::beginTransaction();

            // If schedules are provided, validate availability
            if ($request->has('schedules') && is_array($request->schedules)) {
                foreach ($request->schedules as $schedule) {
                    $availability = $this->checkScheduleAvailability(
                        $request->location_id,
                        $schedule['day_of_week'],
                        $schedule['start_time'] . ':00',
                        $schedule['end_time'] . ':00',
                        $workshop->id
                    );

                    if (!$availability) {
                        throw new \Exception("El horario {$schedule['day_of_week']} de {$schedule['start_time']} a {$schedule['end_time']} no está disponible");
                    }
                }

                // Delete existing schedules and create new ones
                WorkshopSchedule::where('workshop_id', $workshop->id)->delete();

                foreach ($request->schedules as $schedule) {
                    WorkshopSchedule::create([
                        'workshop_id' => $workshop->id,
                        'day_of_week' => $schedule['day_of_week'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time']
                    ]);
                }
            }

            // Update workshop data
            $workshopData = $request->except('schedules');
            $workshop->update($workshopData);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Workshop updated successfully',
                'workshop' => $workshop->load(['instructor', 'location', 'category', 'schedules'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error updating workshop',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $workshop = Workshop::findOrFail($id);
            $workshop->delete();

            return response()->json([
                'status' => true,
                'message' => 'Workshop deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting workshop',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update workshop schedules
     */
    public function updateSchedules(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'schedules' => 'required|array|min:1',
            'schedules.*.day_of_week' => 'required|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'schedules.*.start_time' => 'required|date_format:H:i',
            'schedules.*.end_time' => 'required|date_format:H:i|after:schedules.*.start_time'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $workshop = Workshop::findOrFail($id);

            DB::beginTransaction();

            // Validate schedule availability before updating (excluding current workshop)
            foreach ($request->schedules as $schedule) {
                $availability = $this->checkScheduleAvailability(
                    $workshop->location_id,
                    $schedule['day_of_week'],
                    $schedule['start_time'] . ':00',
                    $schedule['end_time'] . ':00',
                    $workshop->id
                );

                if (!$availability) {
                    throw new \Exception("El horario {$schedule['day_of_week']} de {$schedule['start_time']} a {$schedule['end_time']} no está disponible");
                }
            }

            // Delete existing schedules
            WorkshopSchedule::where('workshop_id', $workshop->id)->delete();

            // Create new schedules
            foreach ($request->schedules as $schedule) {
                WorkshopSchedule::create([
                    'workshop_id' => $workshop->id,
                    'day_of_week' => $schedule['day_of_week'],
                    'start_time' => $schedule['start_time'],
                    'end_time' => $schedule['end_time']
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Workshop schedules updated successfully',
                'workshop' => $workshop->load(['instructor', 'location', 'category', 'schedules'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error updating workshop schedules',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if a schedule time slot is available
     */
    private function checkScheduleAvailability($locationId, $dayOfWeek, $startTime, $endTime, $excludeWorkshopId = null)
    {
        // Check existing workshop schedules
        $query = WorkshopSchedule::join('workshops', 'workshop_schedules.workshop_id', '=', 'workshops.id')
            ->where('workshops.location_id', $locationId)
            ->where('workshop_schedules.day_of_week', $dayOfWeek);

        if ($excludeWorkshopId) {
            $query->where('workshops.id', '!=', $excludeWorkshopId);
        }

        $hasConflict = $query->where(function ($query) use ($startTime, $endTime) {
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
        })->exists();

        return !$hasConflict;
    }

    public function search(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $workshops = Workshop::with(['instructor', 'location', 'category'])
                ->where('name', 'like', '%'.$request->term.'%')
                ->orWhere('age_range', 'like', '%'.$request->term.'%')
                ->orWhere('class_days', 'like', '%'.$request->term.'%')
                ->orWhereHas('instructor', function($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->term.'%');
                })
                ->get();

            return response()->json([
                'status' => true,
                'workshops' => $workshops
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error in search',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
