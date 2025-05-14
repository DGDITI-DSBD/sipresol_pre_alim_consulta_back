<?php


// ***************************

//* File:       oRegController.php
//* Función:    Modificación de datos geenerales y domiciliarios de ciudadanos.
//* Autor:      Ing. Bruno Esteban Martinez Millán
//* Modificó:   Ing. Bruno Esteban Martinez Millán, Ing. Jhovany Jaime Hernández Mendoza, Alfredo Ortiz Guerrero
//* Fecha act.: Diciembre 2024
//* @Derechos reservados. Gobierno del Estado de México

// ***************************

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\si_ctrlLista;
use App\Models\si_ctrlFolio;
use App\Models\si_reg_forms;
use App\Models\si_benefProgs;
use App\Models\si_prereg;



use App\Models\si_cat_documentos;
use App\Models\si_cat_estado_civil;
use App\Models\si_cat_municipios;
use App\Models\si_cat_localidades;
use App\Models\si_cat_sepomex;


use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Log;
use Exception;

class oRegController extends Controller
{

    //Control 
    protected $id, $folio_asignado;

    // metadato
    protected $curp, 
              $nombre,
              $primer_apellido,
              $segundo_apellido,
              $nombre_completo,
              $fecha_nacimiento,
              $id_nacionalidad, 
              $cve_entidad_nacimiento,
              $edad, 
              $sexo,
              $ct_edo_civil,
              $cve_tipo_id_ofcl,
              $id_docto_ofl,
              $calle,
              $num_ext,
              $num_int,
              $entre_calle, 
              $y_calle,
              $otra_referencia,
              $colonia,
              $cve_localidad, 
              $localidad, 
              $cve_municipio,
              $municipio,
              $cve_entidad_federativa,
              $entidad_federativa,
              $codigo_postal,
              $telefono,
              $telefono_fijo,
              $e_mail,
              $cve_asentamiento,
              $grupo_vulnerable;
              
    


    // *****************************************

        //Control y manejo de errores

            // 50000 - Datos de formulario exitoso - Datos generales
            // 50001 - Error de validación         - Reglas de modificación de datos generales
            // 50002 - Error de objeto            - Validación de datos generales
            // 50003 - Error de actualización       - Datos generales - Tabla de lista de espera
            // 50006 - Error de actualización       - Datos generales - Tabla de preregistro - programa
            // 50007 - Error de actualización       - Datos generales - La función falló
            // 50008 - Error de actualización       - Datos domiciliarios
            // 50009 - Error de actualización       - Formulario de preguntas - Estudio socioeconómico
            // 50010 - Error de actualización       - Formulario de preguntas - Estudio socioeconómico - Función de actualización de domicilio
            

    // *****************************************

    //Ejecución de función de validación del registro del prebeneficiario 
    public function updateStatePreRegAccion(Request $request){

        $getForm  = $request -> data;
        $responseFunction = [];

       $responseFunction =  $this -> RulesOfGeneralData($getForm);

       if(is_array($responseFunction) && array_key_exists('success', $responseFunction)){
            $getFlag = $responseFunction['success'];
                if(!$getFlag){
                    return response() -> json($responseFunction);
                }else{

                    $this -> id                      = $getForm['id'];
                    $this -> folio_asignado          = $getForm['folio_asignado'];

                    $this -> nombre                  = strtoupper($getForm['nombre']);
                    $this -> primer_apellido         = strtoupper($getForm['primer_apellido']);
                    $this -> segundo_apellido        = strtoupper($getForm['segundo_apellido']);
                    $this -> fecha_nacimiento        = $getForm['fecha_nacimiento'];
                    $this -> cve_entidad_nacimiento  = $getForm['cve_entidad_nacimiento'];
                    $this -> sexo                    = $getForm['sexo'];
                    $this -> ct_edo_civil            = $getForm['ct_edo_civil'];
                    $this -> cve_tipo_id_ofcl        = $getForm['tp_id_oficial'];
                    $this -> id_docto_ofl            = $getForm['id_oficial'];
                    $this -> telefono                = $getForm['telefono'];
                    $this -> telefono_fijo           = $getForm['telefono_fijo'];
                    $this -> e_mail                  = $getForm['e_mail'];
                    

                    $getEstadoFolio = si_ctrlLista::select('estado_validado', 'estado_verificado')->where('curp', $getForm['curp'])->first();

                        if(!empty($getEstadoFolio) || !is_null($getEstadoFolio) ){

                            try{
                                DB::beginTransaction();

                                $getFilaLista = si_ctrlLista::where('curp', $this -> curp)
                                ->where('id', $this -> id)
                                ->update([
                                    'primer_apellido'        => $this -> primer_apellido,
                                    'segundo_apellido'       => $this -> segundo_apellido,
                                    'nombre'                 => $this -> nombre,
                                    'sexo'                   => $this -> sexo,
                                    'cve_entidad_nacimiento' => $this -> cve_entidad_nacimiento,
                                    'fecha_nacimiento'       => $this -> fecha_nacimiento
                                ]);

                                if($getFilaLista <= 0 || $getFilaLista > 1){
                                    DB::rollback();
                                    return response() -> json([
                                        'success' => false,
                                        'message' => '50003',
                                        'error'   => 'Actualización de datos',
                                        'data'    => []
                                    ], 500);
                                }else{

                                            $getFilaPrereg = si_prereg::where('curp', $this -> curp)
                                            ->where('folio_asignado', $this -> folio_asignado)
                                            ->update([
                                                'telefono'               => $this -> telefono,
                                                'telefono_fijo'          => $this -> telefono_fijo,
                                                'ct_edo_civil'           => $this -> ct_edo_civil,
                                                'cve_tipo_id_ofcl'       => $this -> cve_tipo_id_ofcl,
                                                'id_docto_ofl'           => $this -> id_docto_ofl,
                                                'email'                  => $this -> e_mail
                                            ]);

                                            if($getFilaPrereg <= 0 || $getFilaPrereg > 1){
                                                DB::rollback();  
                                                return response() -> json([
                                                    'success' => false,
                                                    'message' => '50006',
                                                    'error'   => 'Actualización de datos',
                                                    'data'    => []
                                                ], 500);
                                            }else{

                                                    DB::commit();

                                                        return response() -> json([
                                                            'success' => true,
                                                            'message' => '50000',
                                                            'error'   => 'S/D',
                                                            'data'    => [$this -> id]
                                                        ], 200);

                                                }
                                        }   

                                    

                                

                                
                            }catch(Exception $error){
                                return response() -> json([
                                    'success' => false,
                                    'message' => '50007',
                                    'error'   => 'Actualización de datos',
                                    'data'    => []
                                ], 500);
                            }

                        }else{

                            return response() -> json([
                                'success' => true,
                                'message' => 'Sin datos',
                                'data'    => []
                            ], 200);

                        }

                }
       }else{
            return response() -> json($responseFunction, 500);
       }        
    }

    public function updateStatePreRegDomAccion(Request $request){

      

        $getForm  = $request -> data;
        $responseFunction = [];

       $responseFunction =  $this -> RulesOfDomicilioR($getForm);

       Log::info("getValidationDom", array($responseFunction));

       if(is_array($responseFunction) && array_key_exists('success', $responseFunction)){
            Log::info("Existe el objeto", array($responseFunction));

            $getFlag = $responseFunction['success'];
                if(!$getFlag){
                    return response() -> json($responseFunction);
                }else{

                    $this -> id                      = $getForm['id'];
                    $this -> folio_asignado          = $getForm['folio_asignado'];
                    $this -> curp                    = $getForm['curp'];

                    $this -> calle                    = $getForm['calle'];
                    $this -> num_ext                  = $getForm['num_ext'];
                    $this -> num_int                  = strtoupper($getForm['num_int']);
                    $this -> entre_calle              = strtoupper($getForm['entre_calle']);
                    $this -> y_calle                  = strtoupper($getForm['y_calle']);
                    $this -> otra_referencia          = strtoupper($getForm['otra_referencia']);
                    $this -> cve_asentamiento         = $getForm['cve_asentamiento'];
                    $this -> cve_localidad            = $getForm['cve_localidad'] ;
                    //Obtener la descripcion por medio de catálogos
                    $this -> cve_municipio            = $getForm['cve_municipio'];
                    $this -> cve_entidad_federativa   = 15;
                    $this -> entidad_federativa       = 'MEXICO';
                    $this -> codigo_postal            = $getForm['codigo_postal'];
                    

                    $getEstadoFolio = si_ctrlLista::select('no_status')->where('curp', $getForm['curp'])->first();

                        if(!empty($getEstadoFolio) || !is_null($getEstadoFolio) ){

                            try{
                                DB::beginTransaction();

                                $getCatFilMun = si_cat_municipios::select('municipionombre')
                                    ->where('entidadfederativaid', 15)
                                    ->where('municipioid', $this -> cve_municipio)
                                    ->first();

                                $getCatLocalidad = si_cat_localidades::select('desc_localidad')
                                    ->where('cve_entidad_federativa', 15)
                                    ->where('cve_municipio', $this -> cve_municipio)
                                    ->where('cve_localidad', $this -> cve_localidad)
                                    ->first();

                                $getIdCP = si_cat_sepomex::select('cp_sipo')
                                    ->where('cve_municipio', $this -> cve_municipio)
                                    ->where('id_asenta_cpcons', $this -> cve_asentamiento)
                                    ->first();

                                $desc_asenta = si_cat_sepomex::select('desc_asenta')
                                    ->where('cve_municipio', $this -> cve_municipio)
                                    ->where('id_asenta_cpcons', $this -> cve_asentamiento)
                                    ->first();
                                
                                    if((is_null($getCatFilMun) || empty($getCatFilMun)) || 
                                       (is_null($getCatLocalidad) || empty($getCatLocalidad)) || 
                                       (is_null($getIdCP) || empty($getIdCP)) || 
                                       (is_null($desc_asenta) || empty($desc_asenta))){

                                        DB::rollback();
                                        return response() -> json([
                                            'sucess'  => false,
                                            'message' => 'Sin datos',
                                            'status'  => 500,
                                            'data'    => []
                                        ]);

                                    }

                                
                                $getFilaPrereg = si_prereg::where('curp', $this -> curp)
                                ->where('id', $this -> id)
                                ->update([
                                    'calle'                  => $this -> calle,
                                    'num_ext'                => $this -> num_ext,
                                    'num_int'                => $this -> num_int,
                                    'entre_calle'            => $this -> entre_calle,
                                    'y_calle'                => $this -> y_calle,
                                    'otra_referencia'        => $this -> otra_referencia,
                                    'cve_asentamiento'       => $this -> cve_asentamiento,
                                    'colonia'                => $desc_asenta -> desc_asenta,
                                    'cve_localidad'          => $this -> cve_localidad,
                                    'localidad'              => $getCatLocalidad -> desc_localidad,
                                    'cve_municipio'          => $this -> cve_localidad,
                                    'municipio'              => $getCatFilMun -> municipionombre,
                                    'cve_entidad_federativa' => $this -> cve_entidad_federativa,
                                    'entidad_federativa'     => $this -> entidad_federativa,
                                    'codigo_postal'          => $getIdCP -> cp_sipo
                                ]);

                                if($getFilaPrereg <= 0 || $getFilaPrereg > 1){
                                    DB::rollback();
                                    return response() -> json([
                                        'success' => false,
                                        'message' => '50008',
                                        'error'   => 'Actualización de datos',
                                        'data'    => []
                                    ], 500);
                                }else{

                                    DB::commit();

                                                return response() -> json([
                                                    'success' => true,
                                                    'message' => '50000',
                                                    'error'   => 'Actualización de datos',
                                                    'data'    => [$this -> id]
                                                ], 200);

                                }      
                            }catch(Exception $error){
                                return response() -> json([
                                    'success' => false,
                                    'message' => '50007',
                                    'error'   => 'Actualización de datos',
                                    'data'    => []
                                ], 500);
                            }

                        }else{

                            return response() -> json([
                                'success' => true,
                                'message' => 'Sin datos',
                                'data'    => []
                            ], 200);

                        }

                }
       }else{

            Log::info("Sin objeto - exception", array($responseFunction));
            return response() -> json($responseFunction, 500);
       }        
    }
  

    public function RulesOfGeneralData($dataGeneral){

            $info = $dataGeneral;

            try{

            $rules = [
                'curp'                    => ['required', 'max:18', 'regex:/^[a-zA-Z]{1}[aeiouxAEIOUX]{1}[a-zA-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HMhm]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE|as|bc|bs|cc|cs|ch|cl|cm|df|dg|gt|gr|hg|jc|mc|mn|ms|nt|nl|oc|pl|qt|qr|sp|sl|sr|tc|ts|tl|vz|yn|zs|ne)[B-DF-HJ-NP-TV-Z-b-df-hj-np-tv-z]{3}[0-9a-zA-Z]{1}[0-9]{1}$/'],
                'nombre'                  => 'required|max:100',
                'primer_apellido'         => 'required|max:100',
                'segundo_apellido'        => 'required|max:100',
                'fecha_nacimiento'        => 'required|date',
                'id_nacionalidad'         => 'required|numeric',
                //'edad'                    => 'required|numeric', //Calcular
                'sexo'                    => 'required|max:1',
                'telefono'                => 'required|max:10',
                'e_mail'                  => 'email:rfc,dns|min:5|max:50',
                'ct_edo_civil'            => 'required|numeric',
                'tp_id_oficial'           => 'required|numeric',
                'id_oficial'              => 'required|min:10|max:30'
            ];

            $messages = [   
                'required'    => 'Campo obligatorio',
                'date'        => 'El campo debe ser tipo fecha',
                'date_format' => 'El campo no tiene el formato requerido',
                'numeric'     => 'El campo debe ser númerico',
                'max'         => 'Máximo de caracteres',
                'email'       => 'Correo inválido'
            ];

            $backValidation = Validator::make($info, $rules, $messages);

            if($backValidation -> fails()){

                return [
                    'success'   => false,
                    'message'  => '50001',
                    'error'    => 'Datos generales',
                    'data'     => $backValidation -> errors() -> toArray()
                ];

            }

            return [
                'success'   => true,
                'message'  => '50000',
                'data'     => []
            ];
        }catch(Exception $internalError){
            return [
                'success'   => false,
                'message'  => '00000',
                'status'   => 500,
                'error'    => $internalError,
                'data'     => []
            ];
        }

    }

    public function RulesOfDomicilioR($dataDomicilio){

        $info = $dataDomicilio;

        try{

        $rules = [
            'municipio'               => 'required',
            'localidad'               => 'required',
            'cve_asentamiento'        => 'required|numeric',
            'colonia'                 => 'required|max:100',
            'codigo_postal'           => 'required|max:5',
            'calle'                   => 'max:150',
            'num_ext'                 => 'required|max:50',
            'num_int'                 => 'required|max:50',
            'entre_calle'             => Rule::requiredif(empty($info['calle']) || strcmp($info['calle'], 'S/D')),
            'y_calle'                 => Rule::requiredif(empty($info['calle']) || strcmp($info['calle'], 'S/D')),
            'otra_referencia'         => 'required|max:150'
        ];

        $messages = [   
            'required'    => 'Campo obligatorio',
            'date'        => 'El campo debe ser tipo fecha',
            'date_format' => 'El campo no tiene el formato requerido',
            'numeric'     => 'El campo debe ser númerico',
            'max'         => 'Máximo de caracteres'
        ];

        $backValidation = Validator::make($info, $rules, $messages);

        if($backValidation -> fails()){

            return [
                'success'   => false,
                'message'  => '50001',
                'error'    => 'Datos generales',
                'data'     => $backValidation -> errors() -> toArray()
            ];

        }

        return [
            'success'   => true,
            'message'  => '50000',
            'data'     => []
        ];
    }catch(Exception $internalError){
        return [
            'success'   => false,
            'message'  => '00000',
            'status'   => 500,
            'error'    => $internalError,
            'data'     => []
        ];
    }

}
    

    
}
