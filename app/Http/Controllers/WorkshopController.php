<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkshopController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $workshops = Workshop::with(['instructor', 'location', 'category'])->get();

            return response()->json([
                'status' => true,
                'workshops' => $workshops
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
            'class_days' => 'required|string',
            'instructor_id' => 'required|exists:instructors,id',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $workshop = Workshop::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Workshop created successfully',
                'workshop' => $workshop->load(['instructor', 'location', 'category'])
            ], 201);
        } catch (\Exception $e) {
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
            $workshop = Workshop::with(['instructor', 'location', 'category'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'workshop' => $workshop
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
            'class_days' => 'required|string',
            'instructor_id' => 'required|exists:instructors,id',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $workshop = Workshop::findOrFail($id);
            $workshop->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Workshop updated successfully',
                'workshop' => $workshop->load(['instructor', 'location', 'category'])
            ]);
        } catch (\Exception $e) {
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
