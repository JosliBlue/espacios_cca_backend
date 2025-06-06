<?php

namespace App\Http\Controllers;

use App\Models\PostEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostEventController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $postEvents = PostEvent::all();

            return response()->json([
                'status' => true,
                'post_events' => $postEvents
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting post events',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'children_attended' => 'required|integer|min:0',
            'youth_attended' => 'required|integer|min:0',
            'adults_attended' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $postEvent = PostEvent::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Post event created successfully',
                'post_event' => $postEvent
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating post event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $postEvent = PostEvent::findOrFail($id);

            return response()->json([
                'status' => true,
                'post_event' => $postEvent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Post event not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'children_attended' => 'required|integer|min:0',
            'youth_attended' => 'required|integer|min:0',
            'adults_attended' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $postEvent = PostEvent::findOrFail($id);
            $postEvent->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Post event updated successfully',
                'post_event' => $postEvent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating post event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $postEvent = PostEvent::findOrFail($id);
            $postEvent->delete();

            return response()->json([
                'status' => true,
                'message' => 'Post event deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting post event',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
