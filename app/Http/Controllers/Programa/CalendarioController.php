<?php

namespace App\Http\Controllers\Programa;

use App\Http\Controllers\Controller;
use App\Models\Programa\Calendario;
use App\Models\Programa\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    /**
     * Mostrar listado de todos los calendarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendarios = Calendario::get();
        return response()->json(['data' => $calendarios], 200);
    }

    /**
     * Almacenar un nuevo calendario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'programa_id' => 'required|exists:imevis_cat_programas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'letras' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $calendario = Calendario::create($request->all());
        return response()->json(['data' => $calendario, 'message' => 'Calendario creado con éxito'], 201);
    }

    /**
     * Mostrar un calendario específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calendario = Calendario::with('programa')->find($id);
        
        if (!$calendario) {
            return response()->json(['message' => 'Calendario no encontrado'], 404);
        }

        return response()->json(['data' => $calendario], 200);
    }

    /**
     * Actualizar un calendario existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $calendario = Calendario::find($id);
        
        if (!$calendario) {
            return response()->json(['message' => 'Calendario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'programa_id' => 'exists:imevis_cat_programas,id',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date|after:fecha_inicio',
            'letras' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $calendario->update($request->all());
        return response()->json(['data' => $calendario, 'message' => 'Calendario actualizado con éxito'], 200);
    }

    /**
     * Eliminar un calendario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendario = Calendario::find($id);
        
        if (!$calendario) {
            return response()->json(['message' => 'Calendario no encontrado'], 404);
        }

        $calendario->delete();
        return response()->json(['message' => 'Calendario eliminado con éxito'], 200);
    }

    /**
     * Obtener todos los calendarios de un programa específico.
     *
     * @param  int  $programaId
     * @return \Illuminate\Http\Response
     */
    public function getCalendariosByPrograma($programaId)
    {
        $programa = Programa::find($programaId);
        
        if (!$programa) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $calendarios = Calendario::where('programa_id', $programaId)->get();
        return response()->json(['data' => $calendarios], 200);
    }

    /**
     * Obtener calendarios activos (fecha actual entre fecha inicio y fecha fin).
     *
     * @return \Illuminate\Http\Response
     */
    public function getCalendariosActivos()
    {
        $ahora = Carbon::now();
        
        $calendarios = Calendario::with('programa')
            ->where('fecha_inicio', '<=', $ahora)
            ->where('fecha_fin', '>=', $ahora)
            ->get();
            
        return response()->json(['data' => $calendarios], 200);
    }
}