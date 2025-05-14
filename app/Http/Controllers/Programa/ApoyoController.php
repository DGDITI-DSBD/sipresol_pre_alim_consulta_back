<?php

namespace App\Http\Controllers\Programa;

use App\Http\Controllers\Controller;
use App\Models\Programa\Apoyo;
use App\Models\Programa\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApoyoController extends Controller
{
    /**
     * Mostrar listado de todos los apoyos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apoyos = Apoyo::get();
        return response()->json(['data' => $apoyos], 200);
    }

    /**
     * Almacenar un nuevo apoyo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'programa_id' => 'required|exists:imevis_cat_programas,id',
            'tipo_apoyo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_unitario' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $apoyo = Apoyo::create($request->all());
        return response()->json(['data' => $apoyo, 'message' => 'Apoyo creado con éxito'], 201);
    }

    /**
     * Mostrar un apoyo específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apoyo = Apoyo::with('programa')->find($id);
        
        if (!$apoyo) {
            return response()->json(['message' => 'Apoyo no encontrado'], 404);
        }

        return response()->json(['data' => $apoyo], 200);
    }

    /**
     * Actualizar un apoyo existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apoyo = Apoyo::find($id);
        
        if (!$apoyo) {
            return response()->json(['message' => 'Apoyo no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'programa_id' => 'exists:imevis_cat_programas,id',
            'tipo_apoyo' => 'string|max:255',
            'nombre' => 'string|max:255',
            'descripcion' => 'nullable|string',
            'costo_unitario' => 'numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $apoyo->update($request->all());
        return response()->json(['data' => $apoyo, 'message' => 'Apoyo actualizado con éxito'], 200);
    }

    /**
     * Eliminar un apoyo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apoyo = Apoyo::find($id);
        
        if (!$apoyo) {
            return response()->json(['message' => 'Apoyo no encontrado'], 404);
        }

        $apoyo->delete();
        return response()->json(['message' => 'Apoyo eliminado con éxito'], 200);
    }

    /**
     * Obtener todos los apoyos de un programa específico.
     *
     * @param  int  $programaId
     * @return \Illuminate\Http\Response
     */
    public function getApoyosByPrograma($programaId)
    {
        $programa = Programa::find($programaId);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $apoyos = Apoyo::where('programa_id', $programaId)->get();
        return response()->json(['data' => $apoyos], 200);
    }
}