<?php


// ***************************

//* File:       oAuthController.php
//* Función:    Proceso de validación en tres pasos.
//* Autor:      Ing. Bruno Esteban Martinez Millán
//* Modificó:   Ing. Bruno Esteban Martinez Millán, Ing. Jhovany Jaime Hernández Mendoza, Alfredo Ortiz Guerrero
//* Fecha act.: Diciembre 2024
//* @Derechos reservados. Gobierno del Estado de México

// ***************************

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;
use DateTime;
use DateTimeZone;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\si_accesoModel;
use App\Models\si_ctrlFolio;
use App\Models\si_ctrlLista;
use App\Models\si_padron_pe;
use App\Models\si_benefProgs;
use App\Models\si_prereg;
use App\Models\si_reg_forms;
use App\Models\si_cat_nacionalidades;
use App\Models\si_cat_entidad_federativa;

use Tymon\JWTAuth\Facades\JWTAuth;


use Illuminate\Support\Facades\DB;

class oAuthController extends Controller{



    // *****************************************

        //Control y manejo de errores

            // 00000 - Exception

            // 10001 - Datos recibidos de forma nula
            // 20001 - Try catch - 01 - error de consulta en renapo
            // 30001 - Manejador de concurrencia 
            // 40001 - Error al guardar datos - FOLIO DEL CIUDADANO
            // 40002 - Error al guardar datos - LISTA DE PREBENEFICIARIOS 
            // 40003 - Error al guardar datos - LISTA DE BENEFICIARIO - PROGRAMAS
            // 40004 - Error al guardar datos - LISTA DE BENEFICIARIO - PREREGISTRO
            // 40005 - Error de consulta      - DIFERENTE A NACIONALIDAD MEXICANA 
            // 40006 - Error de consulta      - LISTA DE BENEFICIARIO - FORMULARIO
            // 40007 - Error de consulta      - BENEFICIARIO NO ENCONTRADO - CORRUPCIÓN DEL REGISTRO - VERIFICAR EN CONJUNTO
            // 40008 - Excepción de consulta  - CIUDADANA CON CURP DESACTUALIZADA
            // 50001 - Error de autenticación - CREDENCIALES INCORRECTAS.

    // *****************************************


  
        // public function index(Request $request){

        //     $data = $request -> data;

        //         if(!empty($data) || !is_null($data)){

        //             $info = si_ctrlLista::with('preregistro:id,cve_tipo_id_ofl,id_docto_ofl,ct_edo_civil,calle,num_ext,num_int,entre_calle,y_calle,otra_referencia,cve_asentamiento,colonia,cve_localidad,localidad,cve_municipio,municipio,cve_entidad_federativa,codigo_postal,telefono,telefono_fijo,email,fecha_registro,fecha_solicitud')
        //                             ->with('estudio:id,zona,empleo_formal,ingresos_mensuales,seguro_social,bnf_programa,b_programa,parentesco,otro_parentesco,casa,cuartos,personas,tipo_material_paredes,servicios,estudios,otro_estudio,actual_estudio,actual_otro_estudio,falta_comida,jefa_familia,afroamericana,discapacidad,victima,indigena,enfermedad,cuida_personas,repatriada,situacion_pobreza')
        //                             ->selectRaw('curp, primer_apellido,segundo_apellido,nombre,sexo,cve_entidad_nacimiento,cve_nacionalidad,fecha_nacimiento,edad,estado_registro,id')
        //                             ->where('id',$data['id'])
        //                             ->where('curp',$data['curp'])
        //                             ->first();


        //             $success = true;
        //             $message = '1';
        //             $error   = 'S/D';
        //             $data    = $info;

        //         }else{

        //             $success = false;
        //             $message = '40007';
        //             $error   = 'Consulta de datos';
        //             $data    = [];

        //         }


        //         return response() -> json([
        //             'success' => $success,
        //             'message' => $message,
        //             'error'   => $error,
        //             'data'    => $data
        //         ]);


        // }


        public function verifiedBenef(Request $request){

            $curp = $request->curp;
            
            $checkLista = si_ctrlLista::select('curp', 'id')
                        ->where('curp', $curp)
                        ->first(); // Verificar si el ciudadano está en sala 

                $flag = (!empty($checkLista) || !is_null($checkLista)) ? 0 : 1;
                
                    switch($flag){
                        case 1:

                            // Idear función de validación
                            // Recrear estado de curp - //Valida si entra a RENAPO - En revisión si entra a verificar por padron - Requiere verificar en caso de que los otros dos metodos no hayan sido validados
                            return $this -> validarCurp($curp);


                            break;
                        default:

                            $relationCliente = si_ctrlLista::with("preregistro")
                                                           ->with("estudio")
                                                           ->select("curp",
                                                           "edad", "estado_validado", "estado_verificado", "estado_termino", "estado_registro")
                                                ->where("curp",$curp)
                                                ->first();


                                    if(!empty($relationCliente) || !is_null($relationCliente)){

                                        

                                        $success = true;
                                        $message = '1';
                                        $error   = 'S/D';
                                        $data    = $relationCliente;

                                    }else{


                                        
                                        $success = false;
                                        $message = '40007';
                                        $error   = 'Consulta de datos';
                                        $data    = [];

                                    }  
                                    
                                    return response() -> json([
                                        'success' => $success,
                                        'message' => $message,
                                        'error'   => $error,
                                        'data'    => $data
                                    ]);
                        break;

                    }

                    

        }

          // Ejecución de esta función al validar la curp con renapo 
        // Jhovany
        //******************** */

        
        public function validarCurp($curp){
    

            // Jhovany
                // Corregir 

            $url = 'https://bus.edomex.gob.mx/bussrv/sei/dkb_frRENAPO1.php/consulta';
    
            $apiRequest = [
    
                "request" => [
                    "consulta" => "CURP",
                    "data" => [
                        "CURP" => $curp,
                    ]
                ]
                    ];

                    Log::info("Requestapi", array($apiRequest));
    
    
    
                    $username = 'sbienestar';
                    $password = '5sBie3nesAr-';
    
                    try{

                        $options = [
                            'verify' => false
                        ];

                        
                        $response = Http::withBasicAuth($username,$password)
                        ->withOptions($options)
                        ->accept('application/json')
                        ->post($url,$apiRequest);

                        if($response->successful()){
                            $data = $response->json();                            
                            
                            if($data['mensaje'] === 'EXITO' && $data['status']){
    
                                // Mostrar este mensaje si la respuesta es exitosa en algún servicio externo

                                $aComp = strcmp($curp, $data['response'][0]['curp']);

                                    if($aComp != 0){
                                        return response() -> json([
                                            'success' => false,
                                            'message' => 'CURP desactualizada',
                                            'error'   => ''
                                        ], 200);
                                    }

                                    /*
                                Log::info("curpInfo", [$this -> responseCurp($data['response'][0]['apellidoMaterno'],
                                                                  $data['response'][0]['apellidoPaterno'],
                                                                  $data['response'][0]['curp'],
                                                                  $data['response'][0]['cveEntidadNacimiento'],
                                                                  $data['response'][0]['fechaNacimientoAxu'],
                                                                  $data['response'][0]['nacionalidad'],
                                                                  $data['response'][0]['nombre'],
                                                                  $data['response'][0]['sexo'], 
                                                                  1,
                                                                  true, 
                                                                  'servicio activo')]);

                                                                  */
                                
                                /*
                                return response() -> json([$this -> responseCurp(
                                                                  $data['response'][0]['apellidoMaterno'],
                                                                  $data['response'][0]['apellidoPaterno'],
                                                                  $data['response'][0]['curp'],
                                                                  $data['response'][0]['cveEntidadNacimiento'],
                                                                  $data['response'][0]['fechaNacimientoAxu'],
                                                                  $data['response'][0]['nacionalidad'],
                                                                  $data['response'][0]['nombre'],
                                                                  $data['response'][0]['sexo'], 1,
                                                                  true, 
                                                                  'servicio activo')],$response->status());

                                */
                                  
                                  /*
                                return response()->json([
                                    'success'=>true,
                                    'message' => 'servicio activo',
                                    'data' => $data['response'][0]??[],
    
                                ]); 

                                */
                                

                                
                                return response() -> json($this -> responseCurp(
                                                                  $data['response'][0]['apellidoMaterno'],
                                                                  $data['response'][0]['apellidoPaterno'],
                                                                  $data['response'][0]['curp'],
                                                                  $data['response'][0]['cveEntidadNacimiento'],
                                                                  $data['response'][0]['fechaNacimientoAxu'],
                                                                  $data['response'][0]['nacionalidad'],
                                                                  $data['response'][0]['nombre'],
                                                                  $data['response'][0]['sexo'], 1,
                                                                  true, 
                                                                  'servicio activo'),$response->status());
                            }
                            
                            
                            if($data['mensaje'] === 'ERROR' && isset($data['response'][0]['descripcion'])){
    


                                // Si debemos consumir algun servicio externo, deberemos estandarizar este mensaje de respuesta -> 'error de servicio'

                                /*
                                return response()->json([
                                    'success'=>false,
                                    'message' => 'error de servicio'
                                    'error' =>$data['response'][0]['descripcion'],
                                ],400);
                                */

                                
                                    $stateBasic = $this -> checkPadron($curp);

                                    if(empty($stateBasic) || is_null($stateBasic)){
                                       return  $this -> responseCurp("S/D","S/D", $curp,"S/D","S/D","S/D","S/D", "S/D", 3, true, "CURP");
                                    }else{
                                        return $stateBasic;
                                    }


                                /*
                                return response()->json($this -> manageError(false, 
                                'error de servicio', 
                                $response -> status(), 
                                $data['response'][0]['descripcion']), $response -> status());
                                */
                            }
                        }
    
    
                        return response()->json($this -> manageError(
                            false, 
                            'Error de consulta',
                            $response -> status(),
                            'SIPROGEM'
                        ),$response->status());

                        /*
                        return response()->json([
                            'success' =>false,
                            'message' => 'Error de consulta',
                            'status'=>$response->status(),
    
                        ],$response->status());

                        */
                     
                        
                    }catch(Exception $e){
                        

                        return response()->json($this -> manageError(false, 
                        '20001 - Error de consulta', 500, $e -> getMessage()),500);
                        
                        
                        /*
                        return response()->json([
                            'success'=>false,
                            'message'=>'Ocurrio un Error',
                            'error'=> $e->getMessage(),
                        ],500);
                        */

                        
    
                    }
                    
        }


        //********************* */

   

    // Ejecución de esta función en el modal de datos generales. 

    public function controlTokenFolio(Request $request){

        $actual = new DateTime();
        $actual -> setTimeZone(new DateTimeZone("America/Monterrey"));
        $formato = $actual -> format('d/m/Y');

        //El token generado no tiene limite de tiempo (Sin expirar)

        $flag = 0;
        $state = 0;


            $info             = $request -> data;
            $getCurpState     = $info['curp'];
            $getApellPaterno  = $info['apellido_paterno'];
            $getApellMaterno  = $info['apellido_materno'];
            $getNombre        = $info['nombres'];
            $getSexo          = $info['sexo'];
            $getFechaNac      = $info['fecha_nacimiento'];
            $getCveEntidad    = $info['cve_entidad_nacimiento'];
            $getCveNacion     = $info['cve_nacionalidad'];
            $getStateCheck    = $info['estadoCurp'];
            $getDateRegistro  = $formato;


                if(!is_null($getCurpState) || !empty($getCurpState)){

                    //Generar registro por 10 segundos

                        $lock = Cache::lock('MB_'.$getCurpState, 5);
                            if($lock -> get()){
                                // Inicio de llave 
                                try{

                                    $getFolio = $this -> controlAssignFolio();

                                    $getStateReg = [];
                                    
                                    $getStateReg = $this -> verifyingCURP(
                                        $getFolio, 
                                        $getCurpState, 
                                        $getApellMaterno, 
                                        $getApellPaterno,
                                        $getNombre,
                                        $getSexo, 
                                        $getFechaNac,
                                        $getCveEntidad,
                                        $getCveNacion,
                                        $getStateCheck,
                                        $getDateRegistro);

                                        
                                    if(is_array($getStateReg) && array_key_exists('messageException', $getStateReg)){
                                        $release = $getStateReg["messageException"];
                                    }elseif(is_array($getStateReg) && array_key_exists('error', $getStateReg)){

                                        switch ($getStateReg["error"]) {
                                            case '40001':
                                                $release = '40001';
                                                break;
                                            case '40002':
                                                $release = '40002';
                                                break;
                                            case '40003':
                                                $release = '40003';
                                                break;
                                            case '40003':
                                                $release = '40003';
                                                break;
                                            $flag = 1;
                                        }
                                    }else{
                                            $release = $getStateReg["success"];
                                    }

                                        

                                    

                                }catch(Exception $throwback){

                                    $release = $throwback;
                                    $flag = 1;

                                }finally{
                                    $lock -> release();
                                }
                            }else{
                                    $release = '30001';
                                    //return response()->json($this -> manageError(true, '30001', 200, 'Procesando petición'));
                            }

                }


                if($flag != 0){

                $resp = [
                    'success' => false,
                    'message' => $release,
                    'dataResponse' => null
                ];
                
                }else{

                    $resp = [
                        'success' => true,
                        'message' => $release,
                        'dataResponse' => $getFolio
                    ];
                }

                return response() -> json($resp);

    }


    public function checkPadron($getStateCurp){

        $checkPadronDB = si_padron_pe::select('curp', 'primer_apellido', 'segundo_apellido', 'nombre', 'sexo', 'cve_entidad_nacimiento', 'cve_programa')
            ->where('curp', $getStateCurp)
            ->first();


            if(!is_null($checkPadronDB) || !empty($checkPadronDB)){
                return $this -> responseCurp($checkPadronDB -> segundo_apellido,
                                $checkPadronDB -> primer_apellido,
                                $checkPadronDB -> curp,
                                $checkPadronDB -> cve_entidad_nacimiento,
                                $checkPadronDB -> fecha_nacimiento,
                                $checkPadronDB -> nacionalidad,
                                $checkPadronDB -> nombre,
                                $checkPadronDB -> sexo,
                                2,
                                true,
                                'El ciudadano '. $checkPadronDB -> primer_apellido.' '.$checkPadronDB -> segundo_apellido.' '.$checkPadronDB -> nombre.' '. 'fué encontrado en la base de datos historica'
                                );
            }else{
                return [];
            }
            

            
    }

    public function verifyingCURP($si_folio, 
                                  $curp, 
                                  $apellido_materno,
                                  $apellido_paterno,
                                  $nombres,
                                  $sexo,
                                  $fecha_nacimiento, 
                                  $cveEntidadNac,
                                  $cveNacionalidad,
                                  $state,
                                  $fecha_registro){

        try {
            DB::beginTransaction();

            if(empty($apellido_materno) || is_null($apellido_materno)){
                $apellido_materno = "X";
            }

            if(empty($apellido_paterno) || is_null($apellido_paterno)){
                $apellido_paterno = "X";
            }

            if(empty($nombres) || is_null($nombres)){
                $nombres = "X";
            }

            if(empty($sexo) || is_null($sexo)){
                $sexo = "X";
            }

            if(empty($fecha_nacimiento) ||is_null($fecha_nacimiento)){
               $fecha_nacimiento = "S/D";
            }


            $_crFormat = date_create($fecha_nacimiento);
            $_dateFormat1 = date_format($_crFormat, "Y-m-d");
            $_dateFormat2 = date("Y-m-d");

            $edad = $this -> calculateAge($_dateFormat1, $_dateFormat2);


            $getNacionId  = si_cat_nacionalidades::select("cve_pais", "clave_nacionalidad")
                            -> where("clave_nacionalidad", $cveNacionalidad)
                            ->first();

            $getEntidadNac = si_cat_entidad_federativa::select("entidadfed_id", "entidadfed_desc", "entidafed_abrev")
                ->where("entidafed_abrev", $cveEntidadNac)
                ->first();

            $setNacionId = $getNacionId -> cve_pais;
            $setEntidadNac = $getEntidadNac -> entidadfed_id;

            if(empty($setNacionId) || is_null($setNacionId)){
                $setNacionId = 0;
                /*
                if(strcmp($setNacionId, "MEX") != 0){
                    DB::rollback();
                    return response() -> json($this -> manageError(true, "40005", 200, "La C. Debe ser mexicana de nacimiento o naturalización"));
                }
                    */
            }


            if(empty($setEntidadNac) || is_null($setEntidadNac)){
                $setEntidadNac = 0;
            /*
            if(strcmp($setNacionId, "MEX") != 0){
                DB::rollback();
                return response() -> json($this -> manageError(true, "40005", 200, "La C. Debe ser mexicana de nacimiento o naturalización"));
            }
                */
        }


            $newOnCtrlFolio = new si_ctrlFolio();

            $newOnCtrlFolio -> id = $si_folio;
            $newOnCtrlFolio -> curp  = strtoupper(substr($curp, 0, 18));
            
            $newOnCtrlFolio -> save();
                if(!$newOnCtrlFolio -> save()){
                    DB::rollback();
                    return ['error' => '40001'];
                    //return response() -> json($this -> manageError(false, "40001", 500, "Error al guardar los datos"));
                }else{

            $newOnLista = new si_ctrlLista();

            $newOnLista -> id                     = $si_folio;
            $newOnLista -> primer_apellido        = strtoupper(substr($apellido_paterno, 0, 100));
            $newOnLista -> segundo_apellido       = strtoupper(substr($apellido_materno, 0, 100));
            $newOnLista -> nombre                 = strtoupper(substr($nombres, 0, 100));
            $newOnLista -> curp                   = strtoupper(substr($curp, 0, 18));
            $newOnLista -> sexo                   = strtoupper(substr($sexo, 0, 1));
            $newOnLista -> cve_entidad_nacimiento = $setEntidadNac;
            $newOnLista -> fecha_nacimiento       = $_dateFormat1;
            $newOnLista -> edad                   = $edad;
            $newOnLista -> cve_nacionalidad       = $setNacionId;
            $newOnLista -> estado_validado        = $state;
            $newOnLista -> verificado             = 0;
            $newOnLista -> estado_terminado       = 2;
            $newOnLista -> estado_registro        = 3;
            
            $newOnLista -> save();
            if(!$newOnLista -> save()){
                DB::rollback();
                return ["error" => "40002"];
                //return response() -> json($this -> manageError(false, "40002", 500, "Error al guardar los datos"));
            }else{
                
                    $prereg = new si_prereg();

                    $prereg -> si_ctrl_lista_id   = $si_folio;
                    $prereg -> fecha_registro   = $fecha_registro;
                    
                    $prereg -> save();

                    if(!$prereg -> save()){
                        DB::rollback();
                        return ["error" => '40004'];
                }else{

                    $formReg = new si_reg_forms();

                    $formReg -> si_ctrl_lista_id   = $si_folio;
                
                    $formReg -> save();

                    if(!$formReg -> save()){

                        DB::rollback();
                        return ["error" => '40006'];

                    }else{
                         DB::commit();

                         return ['success' => '1'];

                    }


                }
            }
        }
    }catch (Exception $error) {
            return [
                'error' => '40005',
                'messageException' => $error
            ];
        }
    }


    //Implementación con JWT


    protected function auth(Request $request){
        $credentials = $request -> only('email', 'password');
            $valCredentials = JWTAuth::attempt($credentials);
        if(!$valCredentials) {
            $this -> login(false, 'null');
            //return response() -> json(['error' => '50001'], 401);
        }else{
            $this -> login(true, $valCredentials);
        }
    }

    protected function login($state, $token){

            if($state){
                $encpToken = JWTAuth::user();

                    $user = si_accesoModel::find($encpToken->id);

                        return response() -> json([
                            'ok' => $state,
                            'user' => $user,
                            'token' => $token
                        ], 200);
            }else{

                        return response() -> json([
                            'ok' => $state,
                            'user' => 'null',
                            'token' => 'null'
                        ], 401);
                      
            }
    }

    
    // respuesta global 

    public function responseCurp($segundo_apellido,
                                 $primer_apellido,
                                 $curp,
                                 $cve_entidad_nacimiento,
                                 $fecha_nacimiento,
                                 $nacionalidad,
                                 $nombre,
                                 $sexo,
                                 $stateCurp,
                                 $stateBool,
                                 $mensaje){
                                    return [
                                        'apellidoMaterno'       => $segundo_apellido,
                                        'apellidoPaterno'       => $primer_apellido,
                                        'curp'                  => $curp,
                                        'cveEntidadNacimmiento' => $cve_entidad_nacimiento,
                                        'fechaNacimientoAxu'    => $fecha_nacimiento,
                                        'nacionalidad'          => $nacionalidad,
                                        'nombre'                => $nombre,
                                        'sexo'                  => $sexo,
                                        'estadoCurp'            => $stateCurp,
                                        'success'               => $stateBool,
                                        'message'               => $mensaje
                                    ];
                                 }


    public function manageError($getSuccess, $getMessage, $getStatus, $getErrorMessage){
            return [
                'success' => $getSuccess,
                'message' => $getMessage,
                'status'  => $getStatus,
                'error'   => $getErrorMessage
            ];
    }


    public function calculateAge($fecha_nacimiento, $fecha_actual){
        

        $v_birth = [];

        $date_diff = abs(strtotime($fecha_actual) - strtotime($fecha_nacimiento));

        
        $anios = floor($date_diff / (365*60*60*24));
        
        $meses = floor(($date_diff - $anios * 365*60*60*24) / (30*60*60*24));
        
        $dias = floor(($date_diff - $anios * 365*60*60*24 - $meses*30*60*60*24)/ (60*60*24));

        $v_birth = [
            'años' => $anios,
            'meses' => $meses,
            'dias'  => $dias
        ];

        return $anios;


    }

    public function controlAssignFolioSecuencia(){
        // Get next value from sequence
        $sequence = DB::select("SELECT NEXTVAL('folio_seq') as next_id")[0]->next_id;
        
        //Script crear secuencia en bd folio_seq
        //CREATE SEQUENCE folio_seq
        //INCREMENT 1
        //MINVALUE 1
        //MAXVALUE 9999999
        //START 1
        //CACHE 1;


        // Get current year and month
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        
        $fecha = sprintf("%s%s%s", $year, $month, $day);
        // Build composite folio: PREFIX-YEAR-MONTH-SEQUENCE
        // Example: MB-20240101-0000001
        $folio = sprintf("MB%s%07d", $fecha, $sequence);
        
        // Return both the numeric sequence and formatted folio
        return $sequence;
    }

    

    public function controlAssignFolio(){


        $getMax = si_ctrlFolio::max('id');

            if(!is_null($getMax) || !empty($getMax)){

                $setFolio = $getMax + 1;

            }else{
                $setFolio = 1;
            }

            return $setFolio;
    }


}