<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Models\Registro\Resultado;
use App\Models\Registro\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ResultadoController extends Controller
{
    /**
     * Mostrar listado de todos los resultados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Resultado::with('registro');
        
        // Filtros
        if ($request->has('registro_id')) {
            $query->where('registro_id', $request->registro_id);
        }
        
        if ($request->has('resultado')) {
            $query->where('resultado', 'like', '%' . $request->resultado . '%');
        }
        
        // Paginación
        $perPage = $request->has('per_page') ? $request->per_page : 15;
        $resultados = $query->paginate($perPage);
        
        return response()->json(['data' => $resultados], 200);
    }

    /**
     * Almacenar un nuevo resultado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registro_id' => 'required|exists:imevis_registros_solicitudes,id',
            'resultado' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si ya existe un resultado para este registro
        $existente = Resultado::where('registro_id', $request->registro_id)->first();
        if ($existente) {
            return response()->json(['message' => 'Ya existe un resultado para este registro'], 409);
        }

        $resultado = Resultado::create($request->all());
        return response()->json(['data' => $resultado, 'message' => 'Resultado creado con éxito'], 201);
    }

    /**
     * Mostrar un resultado específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resultado = Resultado::with('registro')->find($id);
        
        if (!$resultado) {
            return response()->json(['message' => 'Resultado no encontrado'], 404);
        }

        return response()->json(['data' => $resultado], 200);
    }

    /**
     * Actualizar un resultado existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resultado = Resultado::find($id);
        
        if (!$resultado) {
            return response()->json(['message' => 'Resultado no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'registro_id' => 'exists:imevis_registros_solicitudes,id',
            'resultado' => 'string',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $resultado->update($request->all());
        return response()->json(['data' => $resultado, 'message' => 'Resultado actualizado con éxito'], 200);
    }

    /**
     * Eliminar un resultado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultado = Resultado::find($id);
        
        if (!$resultado) {
            return response()->json(['message' => 'Resultado no encontrado'], 404);
        }

        $resultado->delete();
        return response()->json(['message' => 'Resultado eliminado con éxito'], 200);
    }

    /**
     * Obtener el resultado para un registro específico.
     *
     * @param  int  $registroId
     * @return \Illuminate\Http\Response
     */
    public function getResultadoByRegistro($registroId)
    {
        $registro = Registro::find($registroId);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $resultado = Resultado::where('registro_id', $registroId)->first();
        
        if (!$resultado) {
            return response()->json(['message' => 'No existe resultado para este registro'], 404);
        }
            
        return response()->json(['data' => $resultado], 200);
    }

    /**
     * Crea o actualiza el resultado para un registro específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $registroId
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdateResultadoForRegistro(Request $request, $registroId)
    {
        $registro = Registro::find($registroId);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'resultado' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $resultado = Resultado::updateOrCreate(
                ['registro_id' => $registroId],
                [
                    'resultado' => $request->resultado,
                    'observaciones' => $request->observaciones
                ]
            );
            
            DB::commit();
            return response()->json([
                'data' => $resultado, 
                'message' => 'Resultado guardado con éxito'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error al guardar el resultado', 'error' => $e->getMessage()], 500);
        }
    }
}