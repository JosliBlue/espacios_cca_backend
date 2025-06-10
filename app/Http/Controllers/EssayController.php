<?php

namespace App\Http\Controllers;

use App\Models\Essay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EssayController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $Essays = Essay::with('location')->get();

            return response()->json([
                'status' => true,
                'Essays' => $Essays
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting Essays',
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
            $Essay = Essay::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Essay created successfully',
                'Essay' => $Essay->load('location')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating Essay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $Essay = Essay::with('location')->findOrFail($id);

            return response()->json([
                'status' => true,
                'Essay' => $Essay
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Essay not found'
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
            $Essay = Essay::findOrFail($id);
            $Essay->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Essay updated successfully',
                'Essay' => $Essay->load('location')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating Essay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $Essay = Essay::findOrFail($id);
            $Essay->delete();

            return response()->json([
                'status' => true,
                'message' => 'Essay deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting Essay',
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
            $Essays = Essay::with('location')
                ->whereBetween('date', [$request->start_date, $request->end_date])
                ->get();

            return response()->json([
                'status' => true,
                'Essays' => $Essays
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error filtering Essays',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
