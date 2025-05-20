<?php

namespace App\Http\Controllers;

use App\Models\Ensayo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnsayoController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $ensayos = Ensayo::with('lugar')->get();

            return response()->json([
                'estado' => true,
                'ensayos' => $ensayos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener ensayos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'lugar_id' => 'required|exists:localizaciones,id',
            'fecha' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fin' => 'required|date_format:H:i|after:horario_inicio'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $ensayo = Ensayo::create($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Ensayo creado exitosamente',
                'ensayo' => $ensayo->load('lugar')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al crear ensayo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $ensayo = Ensayo::with('lugar')->findOrFail($id);

            return response()->json([
                'estado' => true,
                'ensayo' => $ensayo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Ensayo no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'lugar_id' => 'required|exists:localizaciones,id',
            'fecha' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fin' => 'required|date_format:H:i|after:horario_inicio'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $ensayo = Ensayo::findOrFail($id);
            $ensayo->update($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Ensayo actualizado exitosamente',
                'ensayo' => $ensayo->load('lugar')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al actualizar ensayo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $ensayo = Ensayo::findOrFail($id);
            $ensayo->delete();

            return response()->json([
                'estado' => true,
                'mensaje' => 'Ensayo eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al eliminar ensayo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filtrarPorFecha(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $ensayos = Ensayo::with('lugar')
                ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
                ->get();

            return response()->json([
                'estado' => true,
                'ensayos' => $ensayos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al filtrar ensayos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
