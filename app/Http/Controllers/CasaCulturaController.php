<?php

namespace App\Http\Controllers;

use App\Models\CasaCultura;
use App\Models\PostEvento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CasaCulturaController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $casasCultura = CasaCultura::with(['lugar', 'categoria', 'postEvento'])->get();

            return response()->json([
                'estado' => true,
                'casas_cultura' => $casasCultura
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener casas de cultura',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fin' => 'required|date_format:H:i|after:horario_inicio',
            'persona_responsable' => 'required|string|max:255',
            'persona_responsable_telefono' => 'required|string|size:10',
            'firma_contrato_recepcion' => 'boolean',
            'reservado' => 'boolean',
            'estado' => 'required|string|in:APROVADO,RECHAZADO',
            'convenio_firmado' => 'boolean',
            'entrega_oficio' => 'boolean',
            'evento' => 'required|string|in:GRATUITO,PAGADO',
            'lugar' => 'required|exists:localizaciones,id',
            'categoria' => 'required|exists:categorias,id'
            // CAMBIADO PARA NO ENVIAR LA ID DE POST EVENTO
            //'post_evento_id' => 'nullable|exists:post_eventos,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            // Crear primero el post evento con valores en 0
            $postEvento = PostEvento::create([
                'infantes_asistido' => 0,
                'jovenes_asistidos' => 0,
                'adultos_asistidos' => 0
            ]);

            // Agregar el id del post evento a los datos de la casa de cultura
            $datosRequest = $request->all();
            $datosRequest['post_evento'] = $postEvento->id;

            $casaCultura = CasaCultura::create($datosRequest);

            return response()->json([
                'estado' => true,
                'mensaje' => 'Casa de cultura creada exitosamente',
                'casa_cultura' => $casaCultura->load(['lugar', 'categoria', 'postEvento'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al crear casa de cultura',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $casaCultura = CasaCultura::with(['lugar', 'categoria', 'postEvento'])->findOrFail($id);

            return response()->json([
                'estado' => true,
                'casa_cultura' => $casaCultura
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Casa de cultura no encontrada'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fin' => 'required|date_format:H:i|after:horario_inicio',
            'persona_responsable' => 'required|string|max:255',
            'persona_responsable_telefono' => 'required|string|size:10',
            'firma_contrato_recepcion' => 'boolean',
            'reservado' => 'boolean',
            'estado' => 'required|string|in:APROVADO,RECHAZADO',
            'convenio_firmado' => 'boolean',
            'entrega_oficio' => 'boolean',
            'evento' => 'required|string|in:GRATUITO,PAGADO',
            'lugar' => 'required|exists:localizaciones,id',
            'categoria' => 'required|exists:categorias,id'
            // CAMBIADO PARA NO ENVIAR LA ID DE POST EVENTO
            //'post_evento' => 'nullable|exists:post_eventos,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $casaCultura = CasaCultura::findOrFail($id);
            $casaCultura->update($request->all());

            return response()->json([
                'estado' => true,
                'mensaje' => 'Casa de cultura actualizada exitosamente',
                'casa_cultura' => $casaCultura->load(['lugar', 'categoria', 'postEvento'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al actualizar casa de cultura',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $casaCultura = CasaCultura::findOrFail($id);
            $casaCultura->delete();

            return response()->json([
                'estado' => true,
                'mensaje' => 'Casa de cultura eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al eliminar casa de cultura',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filtrarPorEstado(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $casasCultura = CasaCultura::with(['lugar', 'categoria', 'postEvento'])
                ->where('estado', $request->estado)
                ->get();

            return response()->json([
                'estado' => true,
                'casas_cultura' => $casasCultura
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al filtrar casas de cultura',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
