<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $instructors = Instructor::all();

            return response()->json([
                'status' => true,
                'instructors' => $instructors
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting instructors',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $instructor = Instructor::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Instructor created successfully',
                'instructor' => $instructor
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating instructor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $instructor = Instructor::findOrFail($id);

            return response()->json([
                'status' => true,
                'instructor' => $instructor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Instructor not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $instructor = Instructor::findOrFail($id);
            $instructor->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Instructor updated successfully',
                'instructor' => $instructor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating instructor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $instructor = Instructor::findOrFail($id);
            $instructor->delete();

            return response()->json([
                'status' => true,
                'message' => 'Instructor deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting instructor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
