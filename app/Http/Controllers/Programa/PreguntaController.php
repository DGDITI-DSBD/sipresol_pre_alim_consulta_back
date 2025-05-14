<?php

namespace App\Http\Controllers\Programa;

use App\Http\Controllers\Controller;
use App\Models\Programa\Pregunta;
use App\Models\Programa\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreguntaController extends Controller
{
    /**
     * Mostrar listado de todas las preguntas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Pregunta::with(['respuestas'])->get();
        return response()->json(['data' => $preguntas], 200);
    }

    /**
     * Almacenar una nueva pregunta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'programa_id' => 'required|exists:cat_programas,id',
            'numero_pregunta' => 'required|integer',
            'tipo_pregunta' => 'required|string|max:255',
            'pregunta_descricion' => 'required|string',
            'requerido' => 'boolean',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pregunta = Pregunta::create($request->all());
        return response()->json(['data' => $pregunta, 'message' => 'Pregunta creada con éxito'], 201);
    }

    /**
     * Mostrar una pregunta específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pregunta = Pregunta::with(['programa', 'respuestas'])->find($id);
        
        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        return response()->json(['data' => $pregunta], 200);
    }

    /**
     * Actualizar una pregunta existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pregunta = Pregunta::find($id);
        
        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'programa_id' => 'exists:cat_programas,id',
            'numero_pregunta' => 'integer',
            'tipo_pregunta' => 'string|max:255',
            'pregunta_descricion' => 'string',
            'requerido' => 'boolean',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pregunta->update($request->all());
        return response()->json(['data' => $pregunta, 'message' => 'Pregunta actualizada con éxito'], 200);
    }

    /**
     * Eliminar una pregunta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregunta = Pregunta::find($id);
        
        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        $pregunta->delete();
        return response()->json(['message' => 'Pregunta eliminada con éxito'], 200);
    }

    /**
     * Obtener todas las respuestas para una pregunta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRespuestas($id)
    {
        $pregunta = Pregunta::find($id);
        
        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        $respuestas = $pregunta->respuestas;
        return response()->json(['data' => $respuestas], 200);
    }

    /**
     * Obtener todas las preguntas de un programa específico.
     *
     * @param  int  $programaId
     * @return \Illuminate\Http\Response
     */
    public function getPreguntasByPrograma($programaId)
    {
        $programa = Programa::find($programaId);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $preguntas = Pregunta::with('respuestas')
            ->where('programa_id', $programaId)
            ->orderBy('numero_pregunta')
            ->get();
            
        return response()->json(['data' => $preguntas], 200);
    }

    /**
     * Obtener solo las preguntas activas de un programa.
     *
     * @param  int  $programaId
     * @return \Illuminate\Http\Response
     */
    public function getPreguntasActivasByPrograma($programaId)
    {
        $programa = Programa::find($programaId);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $preguntas = Pregunta::with('respuestas')
            ->where('programa_id', $programaId)
            ->where('activo', true)
            ->orderBy('numero_pregunta')
            ->get();
            
        return response()->json(['data' => $preguntas], 200);
    }
}