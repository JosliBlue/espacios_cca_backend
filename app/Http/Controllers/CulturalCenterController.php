<?php

namespace App\Http\Controllers;

use App\Models\CulturalCenter;
use App\Models\EventPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CulturalCenterController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $culturalCenters = CulturalCenter::with(['location', 'category', 'eventPost'])
                ->orderBy('date', 'asc')
                ->get();

            return response()->json([
                'status' => true,
                'cultural_centers' => $culturalCenters
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting cultural centers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'responsible_person' => 'required|string|max:255',
            'responsible_person_phone' => 'required|string|size:10',
            'contract_reception_signed' => 'boolean',
            'reserved' => 'boolean',
            'status' => 'required|string|in:Approved,Rejected,Pending',
            'agreement_signed' => 'boolean',
            'official_document_delivered' => 'boolean',
            'event' => 'required|string|in:Free,Paid',
            'location' => 'required|exists:locations,id',
            'category' => 'required|exists:categories,id'
            // CHANGED TO NOT SEND POST EVENT ID
            //'event_post_id' => 'nullable|exists:event_posts,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create post event first with zero values
            $eventPost = EventPost::create([
                'children_attended' => 0,
                'youth_attended' => 0,
                'adults_attended' => 0
            ]);

            // Add post event id to cultural center data
            $requestData = $request->all();
            $requestData['event_post'] = $eventPost->id;

            $culturalCenter = CulturalCenter::create($requestData);

            return response()->json([
                'status' => true,
                'message' => 'Cultural center created successfully',
                'cultural_center' => $culturalCenter->load(['location', 'category', 'eventPost'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating cultural center',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $culturalCenter = CulturalCenter::with(['location', 'category', 'eventPost'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'cultural_center' => $culturalCenter
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Cultural center not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'responsible_person' => 'required|string|max:255',
            'responsible_person_phone' => 'required|string|size:10',
            'contract_reception_signed' => 'boolean',
            'reserved' => 'boolean',
            'status' => 'required|string|in:Approved,Rejected,Pending',
            'agreement_signed' => 'boolean',
            'official_document_delivered' => 'boolean',
            'event' => 'required|string|in:Free,Paid',
            'location' => 'required|exists:locations,id',
            'category' => 'required|exists:categories,id'
            // CHANGED TO NOT SEND POST EVENT ID
            //'event_post' => 'nullable|exists:event_posts,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $culturalCenter = CulturalCenter::findOrFail($id);
            $culturalCenter->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Cultural center updated successfully',
                'cultural_center' => $culturalCenter->load(['location', 'category', 'eventPost'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating cultural center',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $culturalCenter = CulturalCenter::findOrFail($id);
            $culturalCenter->delete();

            return response()->json([
                'status' => true,
                'message' => 'Cultural center deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting cultural center',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByState(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $culturalCenters = CulturalCenter::with(['location', 'category', 'eventPost'])
                ->where('status', $request->status)
                ->get();

            return response()->json([
                'status' => true,
                'cultural_centers' => $culturalCenters
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error filtering cultural centers',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
