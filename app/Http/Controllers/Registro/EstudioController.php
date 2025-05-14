<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Models\Registro\Estudio;
use App\Models\Registro\Registro;
use App\Models\Programa\Pregunta;
use App\Models\Registro\Respuesta;
use App\Models\Registro\Resultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class EstudioController extends Controller
{
    public function store(Request $request)
    {
        Log::info('EstudioController@store');
        $validated = $request->validate([
            'registro_id' => 'required|exists:registros,id',
            'respuestas' => 'required|array',
            'respuestas.*.pregunta_id' => [
                'required',
                'exists:cat_preguntas,id',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $registro_id = $request->input('registro_id');
                    
                    // Check if a response for this question already exists
                    if (Respuesta::where('registro_id', $registro_id)
                        ->where('pregunta_id', $value)
                        ->exists()) {
                        $fail("Ya existe una respuesta para este Registro.");
                    }
                },
            ],
            'respuestas.*.tipo' => [
                'required',
                Rule::in([
                    'opcion_unica',
                    'opcion_multiple',
                    'cantidad_por_opcion',
                    'si_no',
                    'texto_libre',
                    'numero'
                ])
            ],
            'respuestas.*.valor' => 'required',
            'respuestas.*.calificacion' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            foreach ($validated['respuestas'] as $respuestaData) {
                // Crear respuesta principal
                $respuesta = Respuesta::create([
                    'registro_id' => $request->registro_id,
                    'pregunta_id' => $respuestaData['pregunta_id'],
                    'respuesta_si_no' => $this->getSiNoValue($respuestaData),
                    'respuesta_texto' => $this->getTextoValue($respuestaData),
                    'respuesta_numero' => $this->getNumeroValue($respuestaData),
                    'calificacion'=> $respuestaData['calificacion'] ?? null,
                ]);

                // Manejar diferentes tipos de respuestas
                $this->handleTipoRespuesta($respuesta, $respuestaData);
            }

            DB::commit();

            try {
                //Si las respuestas se guardaron correctamente obtener el puntaje ponderado total y guardar en el modelo Resultado
                $respuestas = Respuesta::where('registro_id', $validated['registro_id'])->get();
                $puntaje_ponderacion = $respuestas->sum(function ($respuesta) {
                    return $respuesta->calificacion !== null ? $respuesta->calificacion : 0;
                });

                // Validar que el puntaje de ponderación sea un número
                if (!is_numeric($puntaje_ponderacion)) {
                    throw new \Exception("El puntaje de ponderación calculado no es un número válido.");
                }

                $resultado = Resultado::updateOrCreate(
                    ['registro_id' => $validated['registro_id']],
                    ['resultado' => $puntaje_ponderacion]
                );

                // Guardar el resultado en la tabla de resultados
                $resultado->save();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error al guardar el puntaje ponderado: ' . $e->getMessage());
                return response()->json([
                    'message' => 'Error al guardar el puntaje ponderado: ' . $e->getMessage()
                ], 500);
            }



            return response()->json([
                'message' => 'Respuestas guardadas exitosamente',
                'data' => Respuesta::where('registro_id', $validated['registro_id'])
                    ->get()
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al guardar las respuestas: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getSiNoValue($data)
    {
        return $data['tipo'] === 'si_no' ? (bool)$data['valor'] : null;
    }

    private function getTextoValue($data)
    {
        return $data['tipo'] === 'texto_libre' ? $data['valor'] : null;
    }

    private function getNumeroValue($data)
    {
        return $data['tipo'] === 'numero' ? (int)$data['valor'] : null;
    }

    private function handleTipoRespuesta($respuesta, $data)
    {
        $pregunta = Pregunta::findOrFail($data['pregunta_id']);
        switch ($data['tipo']) {
            case 'opcion_unica':
                $this->validateOpcion($pregunta, $data['valor']);
                $respuesta->opciones()->attach($data['valor']);
                break;

            case 'opcion_multiple':
                $this->validateOpciones($pregunta, $data['valor']);
                $respuesta->opciones()->sync($data['valor']);
                break;

            case 'cantidad_por_opcion':
                $this->handleCantidades($respuesta, $pregunta, $data['valor']);
                break;
        }
    }

    private function validateOpcion($pregunta, $opcionId)
    {
        if (!$pregunta->opciones()->where('id', $opcionId)->exists()) {
            throw new \Exception("La opción {$opcionId} no pertenece a la pregunta {$pregunta->id}");
        }
    }

    private function validateOpciones($pregunta, $opcionesIds)
    {
        $invalidIds = array_diff($opcionesIds, $pregunta->opciones->pluck('id')->toArray());

        if (!empty($invalidIds)) {
            throw new \Exception("Las opciones [" . implode(', ', $invalidIds) . "] no pertenecen a la pregunta {$pregunta->id}");
        }
    }

    private function handleCantidades($respuesta, $pregunta, $cantidades)
    {
        if (!is_array($cantidades)) {
            throw new \Exception("Formato inválido para cantidades en pregunta {$pregunta->id}");
        }

        foreach ($cantidades as $opcionId => $cantidad) {
            $this->validateOpcion($pregunta, $opcionId);

            $respuesta->opciones()->attach($opcionId, [
                'cantidad' => max(0, (int)$cantidad)
            ]);
        }
    }


    public function show($registroId)
    {
        $registro = Registro::with(['respuestas' => function($query) {
            $query->with(['pregunta', 'subpreguntas', 'opciones'])
              ->whereNull('respuesta_padre_id');
        }])->findOrFail($registroId);

        if (!$registro) {
            return response()->json([
            'message' => 'Registro no encontrado'
            ], 404);
        }

        return response()->json([
            'registro_id' => $registro->id,
            'registro'=>$registro,
            'puntaje_ponderacion' => $registro->respuestas->sum(function ($respuesta) {
                return $respuesta->calificacion !== null ? $respuesta->calificacion : 0;
            }),
            'respuestas' => $registro->respuestas->map(function($respuestas) {
                return $this->formatearRespuesta($respuestas);
            })
        ]);
    }

    private function formatearRespuesta($respuestas)
    {
        $base = [
            'pregunta_id' => $respuestas->pregunta_id,
            'texto_pregunta' => $respuestas->pregunta->pregunta_descripcion,
            'tipo' => $respuestas->pregunta->tipo_pregunta,
            'calificacion'=> $respuestas->calificacion,
        ];

        switch($respuestas->pregunta->tipo_pregunta) {
            case 'numero':
                $base['respuesta'] = $respuestas->respuesta_numero;
                break;
            case 'si_no':
                $base['respuesta'] = $respuestas->respuesta_si_no;
                break;
                
            case 'opcion_unica':
                $base['respuesta'] = $respuestas->opciones->first()->texto ?? null;
                break;
                
            case 'opcion_multiple':
                $base['respuesta'] = $respuestas->opciones->pluck('texto');
                break;
                
            case 'cantidad_por_opcion':
                $base['respuesta'] = $respuestas->opciones->mapWithKeys(function($item) {
                    return [$item->texto => $item->pivot->cantidad];
                });
                break;
                
            case 'texto_libre':
                $base['respuesta'] = $respuestas->respuesta_texto;
                break;
        }

        return $base;
    }



}
