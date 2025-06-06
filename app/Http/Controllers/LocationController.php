<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $locations = Location::all();

            return response()->json([
                'status' => true,
                'locations' => $locations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting locations',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:locations'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $location = Location::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Location created successfully',
                'location' => $location
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating location',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $location = Location::findOrFail($id);

            return response()->json([
                'status' => true,
                'location' => $location
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Location not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:locations,name,'.$id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $location = Location::findOrFail($id);
            $location->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Location updated successfully',
                'location' => $location
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating location',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $location = Location::findOrFail($id);
            $location->delete();

            return response()->json([
                'status' => true,
                'message' => 'Location deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting location',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
