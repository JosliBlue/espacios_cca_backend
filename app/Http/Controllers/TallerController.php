<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TallerController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $talleres = Taller::with(['instructor', 'lugar', 'categoria'])->get();

            return response()->json([
                'estado' => true,
                'talleres' => $talleres
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener talleres',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'costo_mensual' => 'required|numeric',
            'edad' => 'required|string|max:50',
            'dias_de_clase' => 'required|string',
            'instructor_id' => 'required|exists:instructores,id',
            'lugar_id' => 'required|exists:localizaciones,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $taller = Taller::create($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Taller creado exitosamente',
                'taller' => $taller->load(['instructor', 'lugar', 'categoria'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al crear taller',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $taller = Taller::with(['instructor', 'lugar', 'categoria'])->findOrFail($id);

            return response()->json([
                'estado' => true,
                'taller' => $taller
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Taller no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'costo_mensual' => 'required|numeric',
            'edad' => 'required|string|max:50',
            'dias_de_clase' => 'required|string',
            'instructor_id' => 'required|exists:instructores,id',
            'lugar_id' => 'required|exists:localizaciones,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $taller = Taller::findOrFail($id);
            $taller->update($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Taller actualizado exitosamente',
                'taller' => $taller->load(['instructor', 'lugar', 'categoria'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al actualizar taller',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $taller = Taller::findOrFail($id);
            $taller->delete();

            return response()->json([
                'estado' => true,
                'mensaje' => 'Taller eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al eliminar taller',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function buscar(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'termino' => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $talleres = Taller::with(['instructor', 'lugar', 'categoria'])
                ->where('nombre', 'like', '%'.$request->termino.'%')
                ->orWhere('edad', 'like', '%'.$request->termino.'%')
                ->orWhere('dias_de_clase', 'like', '%'.$request->termino.'%')
                ->orWhereHas('instructor', function($query) use ($request) {
                    $query->where('nombre', 'like', '%'.$request->termino.'%');
                })
                ->get();

            return response()->json([
                'estado' => true,
                'talleres' => $talleres
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error en la búsqueda',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
