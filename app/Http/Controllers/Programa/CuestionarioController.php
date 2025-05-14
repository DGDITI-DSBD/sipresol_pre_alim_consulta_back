<?php

namespace App\Http\Controllers\Programa;

use App\Models\Programa\Pregunta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuestionarioController extends Controller
{
    // Obtener estructura completa del cuestionario
    public function index()
    {
        $preguntas = Pregunta::with(['opciones', 'subpreguntas.opciones'])
            ->whereNull('depende_de')
            ->get();

        return response()->json([
            'total' => $preguntas->count(),
            'preguntas' => $preguntas->map(function($pregunta) {
            return $this->formatearPregunta($pregunta);
            }),
            
        ]);
    }

    private function formatearPregunta($pregunta)
    {
        return [
            'id' => $pregunta->id,
            'programa' => $pregunta->programa_id,
            'requerida' => $pregunta->requerido,
            'activa' => $pregunta->activo,
            'numero' => $pregunta->numero_pregunta,
            'texto' => $pregunta->pregunta_descripcion,
            'tipo' => $pregunta->tipo_pregunta,
            'depende_de' => $pregunta->depende_de,
            'depende_respuesta'=> $pregunta->depende_respuesta,
            'opciones' => $pregunta->opciones->map(function($opcion) {
                return [
                    'id' => $opcion->id,
                    'texto' => $opcion->texto,
                    'valor' => $opcion->valor,
                ];
            }),
            'subpreguntas' => $pregunta->subpreguntas->map(function($subpregunta) {
                return $this->formatearPregunta($subpregunta);
            })
        ];
    }
}