<?php

namespace App\Http\Controllers;

use App\Models\Localizacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocalizacionController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $localizaciones = Localizacion::all();

            return response()->json([
                'estado' => true,
                'localizaciones' => $localizaciones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener localizaciones',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:localizaciones'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $localizacion = Localizacion::create($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Localización creada exitosamente',
                'localizacion' => $localizacion
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al crear localización',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $localizacion = Localizacion::findOrFail($id);

            return response()->json([
                'estado' => true,
                'localizacion' => $localizacion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Localización no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:localizaciones,nombre,'.$id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $localizacion = Localizacion::findOrFail($id);
            $localizacion->update($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Localización actualizada exitosamente',
                'localizacion' => $localizacion
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al actualizar localización',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $localizacion = Localizacion::findOrFail($id);
            $localizacion->delete();

            return response()->json([
                'estado' => true,
                'mensaje' => 'Localización eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al eliminar localización',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
