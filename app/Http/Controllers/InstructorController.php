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
            $instructores = Instructor::all();

            return response()->json([
                'estado' => true,
                'instructores' => $instructores
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener instructores',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $instructor = Instructor::create($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Instructor creado exitosamente',
                'instructor' => $instructor
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al crear instructor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $instructor = Instructor::findOrFail($id);

            return response()->json([
                'estado' => true,
                'instructor' => $instructor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Instructor no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $instructor = Instructor::findOrFail($id);
            $instructor->update($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Instructor actualizado exitosamente',
                'instructor' => $instructor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al actualizar instructor',
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
                'estado' => true,
                'mensaje' => 'Instructor eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al eliminar instructor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
