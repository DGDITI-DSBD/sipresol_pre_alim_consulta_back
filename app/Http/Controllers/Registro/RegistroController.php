<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\PadronHistorico;
use App\Models\PadronActivo;
use App\Models\Registro\Registro;
use App\Models\Programa\Programa;
use App\Models\Registro\Resultado;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    /**
     * Mostrar listado de todos los registros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Registro::with(['programa', 'estudio']);

        // Filtros
        if ($request->has('programa_id')) {
            $query->where('programa_id', $request->programa_id);
        }
        
        if ($request->has('estado_registro')) {
            $query->where('estado_registro', $request->estado_registro);
        }
        
        if ($request->has('es_beneficiario')) {
            $query->where('es_beneficiario', $request->es_beneficiario);
        }
        
        if ($request->has('folio')) {
            $query->where('folio', 'like', '%' . $request->folio . '%')
                  ->orWhere('folio_relacionado', 'like', '%' . $request->folio . '%');
        }
        
        if ($request->has('curp')) {
            $query->where('curp', $request->curp);
        }
        
        if ($request->has('nombre')) {
            $nombre = $request->nombre;
            $query->where(function($q) use ($nombre) {
                $q->where('nombres', 'like', '%' . $nombre . '%')
                  ->orWhere('primer_ap', 'like', '%' . $nombre . '%')
                  ->orWhere('segundo_ap', 'like', '%' . $nombre . '%');
            });
        }

        // Paginación
        $perPage = $request->has('per_page') ? $request->per_page : 15;
        $registros = $query->paginate($perPage);
        
        return response()->json(['data' => $registros], 200);
    }


    public function buscarPorCurp(Request $request)
    {
        $query = Registro::with(['programa']);
        
   
        if ($request->has('curp')) {
            $curp = $request->curp;
            $query->where(function($q) use ($curp) {
                $q->where('curp', '=', $curp);
            });
        }
        

        // Paginación
        //$perPage = $request->has('per_page') ? $request->per_page : 15;
        $registros = $query->first();
        
        return response()->json(['data' => $registros], 200);
    }

    /**
     * Almacenar un nuevo registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'programa_id' => 'required|exists:cat_programas,id',
            'apoyo_id' => 'nullable|exists:cat_apoyos,id',
            'calendario_id' => 'nullable|exists:cat_calendarios,id',
            'fecha_solicitud' => 'required|date',
            'estado_validacion_renapo' => 'integer',
            'estado_solicitud' => 'integer',
            'estado_beneficiario' => 'integer',
            'cedis_id' => 'nullable|exists:cat_cedis,id',

            'primer_ap' => 'required|string|max:100',
            'segundo_ap' => 'nullable|string|max:100',
            'nombres' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer|max:120',
            'genero' => 'required|string|max:20',
            'ct_edo_civil' => 'required|string|max:50',
            'ct_escolaridad' => 'required|string|max:50',
            'tp_id_oficial' => 'required|string|max:50',
            'id_oficial' => 'required|string|max:50',
            'ct_ent_nac' => 'required|string|max:50',
            'curp' => 'required|string|size:18|unique:registros,curp',
            'calle' => 'required|string|max:150',
            'num_ext' => 'required|string|max:20',
            'num_int' => 'nullable|string|max:20',
            'entre_calle' => 'nullable|string|max:150',
            'y_calle' => 'nullable|string|max:150',
            'otra_referencia' => 'nullable|string|max:200',
            'colonia' => 'required|string|max:150',
            'ct_localidad' => 'required|string|max:50',
            'localidad' => 'required|string|max:150',
            'ct_municipio' => 'required|string|max:50',
            'municipio' => 'required|string|max:150',
            'ct_entidad_federativa' => 'required|string|max:50',
            'entidad_federativa' => 'required|string|max:100',
            'codigo_postal_id' => 'required|exists:cat_codigos_postales,asentamiento_id',
            'codigo_postal' => 'required|string|size:5',
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $registro = Registro::create($request->all());
            
            DB::commit();
            return response()->json([
                'data' => $registro, 
                'message' => 'Registro creado con éxito',
                'folio' => $registro->folio_solicitud,
                'folio_relacionado' => $registro->folio_relacionado
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error al crear el registro', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Mostrar un registro específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = (int)$id;

        $registro = Registro::find($id);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        return response()->json(['data' => $registro], 200);
    }

    /**
     * Buscar un registro por folio.
     *
     * @param  string  $folio
     * @return \Illuminate\Http\Response
     */
    public function buscarPorFolio($folio)
    {
        $registro = Registro::with(['programa', 'estudio'])
            ->where('folio', $folio)
            ->orWhere('folio_relacionado', $folio)
            ->first();
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        return response()->json(['data' => $registro], 200);
    }

    /**
     * Actualizar un registro existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $registro = Registro::find($id);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'programa_id' => 'exists:imevis_cat_programas,id',
            'apoyo_id' => 'nullable|exists:imevis_cat_apoyos,id',
            'calendario_id' => 'nullable|exists:imevis_cat_calendarios,id',
            'estado_registro' => 'string',
            'es_beneficiario' => 'boolean',
            'primer_ap' => 'string|max:100',
            'segundo_ap' => 'nullable|string|max:100',
            'nombres' => 'string|max:100',
            'fecha_nacimiento' => 'date',
            'edad' => 'integer|min:18|max:120',
            'genero' => 'string|max:20',
            'ct_edo_civil' => 'string|max:50',
            'tp_id_oficial' => 'string|max:50',
            'id_oficial' => 'string|max:50',
            'ct_ent_nac' => 'string|max:50',
            'curp' => 'string|size:18',
            'calle' => 'string|max:150',
            'num_ext' => 'string|max:20',
            'num_int' => 'nullable|string|max:20',
            'entre_calle' => 'nullable|string|max:150',
            'y_calle' => 'nullable|string|max:150',
            'otra_referencia' => 'nullable|string|max:200',
            'colonia' => 'string|max:150',
            'ct_localidad' => 'string|max:50',
            'localidad' => 'string|max:150',
            'ct_municipio' => 'string|max:50',
            'municipio' => 'string|max:150',
            'ct_entidad_federativa' => 'string|max:50',
            'entidad_federativa' => 'string|max:100',
            'codigo_postal' => 'string|size:5',
            'telefono' => 'string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // No permitir cambios en los folios
        $request->request->remove('folio');
        $request->request->remove('folio_relacionado');

        $registro->update($request->all());
        return response()->json(['data' => $registro, 'message' => 'Registro actualizado con éxito'], 200);
    }

    /**
     * Eliminar un registro.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Registro::find($id);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        // Eliminar registro y relaciones asociadas
        DB::beginTransaction();
        try {
            $registro->delete();
            DB::commit();
            return response()->json(['message' => 'Registro eliminado con éxito'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error al eliminar el registro', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Actualizar el estado de un registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarEstado(Request $request, $id)
    {
        $registro = Registro::find($id);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'estado_registro' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $registro->estado_registro = $request->estado_registro;
        $registro->save();

        return response()->json(['data' => $registro, 'message' => 'Estado del registro actualizado con éxito'], 200);
    }

    /**
     * Marcar/desmarcar registro como beneficiario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarBeneficiario(Request $request, $id)
    {
        $registro = Registro::find($id);
        
        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'es_beneficiario' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $registro->es_beneficiario = $request->es_beneficiario;
        $registro->save();

        return response()->json(['data' => $registro, 'message' => 'Estado de beneficiario actualizado con éxito'], 200);
    }


    /**
     * Verificar si existe un registro previo con la CURP proporcionada.
     *
     * @param  string  $curp
     * @return \Illuminate\Http\Response
     */
    public function verificarCurp(Request $request)
    {

        $validated = $request->validate([
            'curp' => 'required|string|size:18',
            'captchaToken' => 'required|string',
        ]);

        // 2. Validar reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('captchaToken'),
            'remoteip' => $request->ip()
        ]);

        $captchaData = $response->json();

        // 3. Verificar respuesta de Google
        if (!$captchaData['success']) {
            return response()->json([
                'success' => false,
                'errors' => ['captcha' => 'Error en la verificación CAPTCHA']
            ], 422);
        }

        // Validar formato de CURP
        $validator = Validator::make(['curp' => $request->curp], [
            'curp' => 'required|string|size:18',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'CURP inválida', 'errors' => $validator->errors()], 422);
        }

        // Buscar si existe registro con la CURP
        $existe = Registro::where('curp', $request->curp)->exists();
        
        if ($existe) {

            $registro = Registro::where('curp', $request->curp)->first();
            //buscar en resultado si hay registro
            $existeResultado = Resultado::where('registro_id', $registro->id)->exists();
            if ($existeResultado || $registro->estado_beneficiario == 300) {
                return response()->json(['existe' => true, 'existeResultado'=>true, 'message' => 'Has concluido tu registro'], 200);
            }
            return response()->json(['existe' => true, 'registro_id'=>$registro->id ,'existeResultado'=>false, 'message' => 'Ya existe un registro con esta CURP'], 200);
        }

        return response()->json(['existe' => false, 'message' => 'No existe registro previo con esta CURP'], 200);
    }

    /**
     * Buscar coincidencia en Padrón Histórico por CURP.
     *
     * @param  string  $curp
     * @return \Illuminate\Http\Response
     */
    public function buscarEnPadronHistorico($curp)
    {
        // Validar formato de CURP
        $validator = Validator::make(['curp' => $curp], [
            'curp' => 'required|string|size:18',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'CURP inválida', 'errors' => $validator->errors()], 422);
        }

        // Buscar en el Padrón Histórico
        $registro = PadronHistorico::where('curp', $curp)->first();
        
        if (!$registro) {
            return response()->json(['existe' => false, 'message' => 'No se encontró registro en el padrón histórico con esta CURP'], 200);
        }

        return response()->json([
            'existe' => true, 
            'message' => 'Registro encontrado en el padrón histórico',
            'data' => $registro
        ], 200);
    }

    public function buscarEnPadronActivo($curp){
        // Validar formato de CURP
        $validator = Validator::make(['curp' => $curp], [
            'curp' => 'required|string|size:18',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'CURP inválida', 'errors' => $validator->errors()], 422);
        }

        // Buscar en el Padrón Activo
        $registro = PadronActivo::where('curp', $curp)->first();
        
        if (!$registro) {
            return response()->json(['existe' => false, 'message' => 'No se encontró registro en el padrón activo con esta CURP'], 200);
        }

        return response()->json([
            'existe' => true, 
            'folio_relacionado' => $registro->folio_relacionado,
            'message' => 'Registro encontrado en el padrón activo',
            'data' => $registro
        ], 200);
    }


    /**
     * Buscar un registro por UUID.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function buscarPorUuid($uuid)
    {
        $registro = Registro::where('uuid', $uuid)->first();

        if (!$registro) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        return response()->json(['data' => $registro], 200);
    }

}