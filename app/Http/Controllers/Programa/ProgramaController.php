<?php

namespace App\Http\Controllers\Programa;

use App\Http\Controllers\Controller;
use App\Models\Programa\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramaController extends Controller
{
    /**
     * Mostrar listado de todos los programas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programas = Programa::all();
        return response()->json(['data' => $programas], 200);
    }

    /**
     * Almacenar un nuevo programa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'r_secretaria' => 'required|string|max:255',
            'organismo_ejecutor' => 'required|string|max:255',
            'unidad_ejecutora' => 'required|string|max:255',
            'nombre_del_programa' => 'required|string|max:255',
            'vertiente' => 'required|string|max:255',
            'anio' => 'required|integer|min:2000|max:2100',
            'periodicidad' => 'required|string|max:50',
            'trimestre' => 'required|string|max:50',
            'grupo_vuln_poblacion_atendida' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $programa = Programa::create($request->all());
        return response()->json(['data' => $programa, 'message' => 'Programa creado con éxito'], 201);
    }

    /**
     * Mostrar un programa específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programa = Programa::with(['apoyos', 'calendario'])->find($id);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        return response()->json(['data' => $programa], 200);
    }

    /**
     * Actualizar un programa existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $programa = Programa::find($id);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'r_secretaria' => 'string|max:255',
            'organismo_ejecutor' => 'string|max:255',
            'unidad_ejecutora' => 'string|max:255',
            'nombre_del_programa' => 'string|max:255',
            'vertiente' => 'string|max:255',
            'anio' => 'integer|min:2000|max:2100',
            'periodicidad' => 'string|max:50',
            'trimestre' => 'string|max:50',
            'grupo_vuln_poblacion_atendida' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $programa->update($request->all());
        return response()->json(['data' => $programa, 'message' => 'Programa actualizado con éxito'], 200);
    }

    /**
     * Eliminar un programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programa = Programa::find($id);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $programa->delete();
        return response()->json(['message' => 'Programa eliminado con éxito'], 200);
    }

    /**
     * Obtener los apoyos asociados a un programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getApoyos($id)
    {
        $programa = Programa::find($id);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $apoyos = $programa->apoyos;
        return response()->json(['data' => $apoyos], 200);
    }

    /**
     * Obtener los calendarios asociados a un programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCalendarios($id)
    {
        $programa = Programa::find($id);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $calendarios = $programa->calendario;
        return response()->json(['data' => $calendarios], 200);
    }
}