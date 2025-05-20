<?php

namespace App\Http\Controllers;

use App\Models\PostEvento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostEventoController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $postEventos = PostEvento::all();

            return response()->json([
                'estado' => true,
                'post_eventos' => $postEventos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener post eventos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'infantes_asistido' => 'required|integer|min:0',
            'jovenes_asistidos' => 'required|integer|min:0',
            'adultos_asistidos' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $postEvento = PostEvento::create($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Post evento creado exitosamente',
                'post_evento' => $postEvento
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al crear post evento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $postEvento = PostEvento::findOrFail($id);

            return response()->json([
                'estado' => true,
                'post_evento' => $postEvento
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Post evento no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'infantes_asistido' => 'required|integer|min:0',
            'jovenes_asistidos' => 'required|integer|min:0',
            'adultos_asistidos' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $postEvento = PostEvento::findOrFail($id);
            $postEvento->update($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Post evento actualizado exitosamente',
                'post_evento' => $postEvento
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al actualizar post evento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $postEvento = PostEvento::findOrFail($id);
            $postEvento->delete();

            return response()->json([
                'estado' => true,
                'mensaje' => 'Post evento eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al eliminar post evento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
