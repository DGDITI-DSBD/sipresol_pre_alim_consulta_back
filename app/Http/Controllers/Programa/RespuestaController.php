<?php

namespace App\Http\Controllers\Programa;

use App\Http\Controllers\Controller;
use App\Models\Programa\Respuesta;
use App\Models\Programa\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RespuestaController extends Controller
{
    /**
     * Mostrar listado de todas las respuestas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respuestas = Respuesta::get();
        return response()->json(['data' => $respuestas], 200);
    }

    /**
     * Almacenar una nueva respuesta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pregunta_id' => 'required|exists:imevis_cat_preguntas,id',
            'respuesta_texto' => 'required|string',
            'respuesta_valor' => 'nullable|string',
            'pregunta_dependiente_id' => 'nullable|exists:imevis_cat_preguntas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $respuesta = Respuesta::create($request->all());
        return response()->json(['data' => $respuesta, 'message' => 'Respuesta creada con éxito'], 201);
    }

    /**
     * Mostrar una respuesta específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respuesta = Respuesta::with('pregunta')->find($id);
        
        if (!$respuesta) {
            return response()->json(['message' => 'Respuesta no encontrada'], 404);
        }

        return response()->json(['data' => $respuesta], 200);
    }

    /**
     * Actualizar una respuesta existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = Respuesta::find($id);
        
        if (!$respuesta) {
            return response()->json(['message' => 'Respuesta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'pregunta_id' => 'exists:imevis_cat_preguntas,id',
            'respuesta_texto' => 'string',
            'respuesta_valor' => 'nullable|string',
            'pregunta_dependiente_id' => 'nullable|exists:imevis_cat_preguntas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $respuesta->update($request->all());
        return response()->json(['data' => $respuesta, 'message' => 'Respuesta actualizada con éxito'], 200);
    }

    /**
     * Eliminar una respuesta (soft delete).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Respuesta::find($id);
        
        if (!$respuesta) {
            return response()->json(['message' => 'Respuesta no encontrada'], 404);
        }

        $respuesta->delete();
        return response()->json(['message' => 'Respuesta eliminada con éxito'], 200);
    }

    /**
     * Obtener todas las respuestas para una pregunta específica.
     *
     * @param  int  $preguntaId
     * @return \Illuminate\Http\Response
     */
    public function getRespuestasByPregunta($preguntaId)
    {
        $pregunta = Pregunta::find($preguntaId);
        
        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        $respuestas = Respuesta::where('pregunta_id', $preguntaId)->get();
        return response()->json(['data' => $respuestas], 200);
    }

    /**
     * Restaurar una respuesta eliminada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $respuesta = Respuesta::withTrashed()->find($id);
        
        if (!$respuesta) {
            return response()->json(['message' => 'Respuesta no encontrada'], 404);
        }
        
        if (!$respuesta->trashed()) {
            return response()->json(['message' => 'La respuesta no está eliminada'], 400);
        }

        $respuesta->restore();
        return response()->json(['message' => 'Respuesta restaurada con éxito'], 200);
    }
}