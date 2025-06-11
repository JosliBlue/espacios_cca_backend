<?php

namespace App\Http\Controllers;

use App\Models\SpaceReservation;
use App\Models\PostEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpaceReservationController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $SpaceReservations = SpaceReservation::with(['location', 'category', 'postEvent'])
                ->orderBy('date', 'asc')
                ->get();

            return response()->json([
                'status' => true,
                'space_reservations' => $SpaceReservations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error getting space reservations',
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
            'status' => 'required|string|in:Aprobado,Rechazado,Pendiente',
            'agreement_signed' => 'boolean',
            'delivery_document' => 'boolean',
            'event_type' => 'required|string|in:Gratuito,Pagado',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id'
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
            $postEvent = PostEvent::create([
                'children_attended' => 0,
                'youth_attended' => 0,
                'adults_attended' => 0
            ]);

            // Add post event id to space reservation data
            $requestData = $request->all();
            $requestData['post_event_id'] = $postEvent->id;

            $SpaceReservation = SpaceReservation::create($requestData);

            return response()->json([
                'status' => true,
                'message' => 'space reservation created successfully',
                'space_reservation' => $SpaceReservation->load(['location', 'category', 'postEvent'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating space reservation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $SpaceReservation = SpaceReservation::with(['location', 'category', 'postEvent'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'space_reservation' => $SpaceReservation
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'space reservation not found'
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
            'status' => 'required|string|in:Aprobado,Rechazado,Pendiente',
            'agreement_signed' => 'boolean',
            'official_document_delivered' => 'boolean',
            'event_type' => 'required|string|in:Gratuito,Pagado',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id'
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
            $SpaceReservation = SpaceReservation::findOrFail($id);
            $SpaceReservation->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'space reservation updated successfully',
                'space_reservation' => $SpaceReservation->load(['location', 'category', 'postEvent'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating space reservation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $SpaceReservation = SpaceReservation::findOrFail($id);
            $SpaceReservation->delete();

            return response()->json([
                'status' => true,
                'message' => 'space reservation deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting space reservation',
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
            $SpaceReservations = SpaceReservation::with(['location', 'category', 'postEvent'])
                ->where('status', $request->status)
                ->get();

            return response()->json([
                'status' => true,
                'space_reservations' => $SpaceReservations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error filtering space reservations',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
