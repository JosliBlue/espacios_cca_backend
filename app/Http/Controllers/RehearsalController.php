<?php

namespace App\Http\Controllers;

use App\Models\Rehearsal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RehearsalController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $rehearsals = Rehearsal::with('location')->get();

            return response()->json([
                'status' => true,
                'rehearsals' => $rehearsals
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting rehearsals',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $rehearsal = Rehearsal::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Rehearsal created successfully',
                'rehearsal' => $rehearsal->load('location')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating rehearsal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $rehearsal = Rehearsal::with('location')->findOrFail($id);

            return response()->json([
                'status' => true,
                'rehearsal' => $rehearsal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Rehearsal not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $rehearsal = Rehearsal::findOrFail($id);
            $rehearsal->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Rehearsal updated successfully',
                'rehearsal' => $rehearsal->load('location')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating rehearsal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $rehearsal = Rehearsal::findOrFail($id);
            $rehearsal->delete();

            return response()->json([
                'status' => true,
                'message' => 'Rehearsal deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting rehearsal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByDate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $rehearsals = Rehearsal::with('location')
                ->whereBetween('date', [$request->start_date, $request->end_date])
                ->get();

            return response()->json([
                'status' => true,
                'rehearsals' => $rehearsals
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error filtering rehearsals',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
