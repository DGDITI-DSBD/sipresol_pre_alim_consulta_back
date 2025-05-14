<?php


// ***************************

//* File:       oRegEstudiosController.php
//* Función:    Modificación de datos de estudio socioeconómico.
//* Autor:      Ing. Bruno Esteban Martinez Millán
//* Modificó:   Ing. Bruno Esteban Martinez Millán, Ing. Jhovany Jaime Hernández Mendoza, Alfredo Ortiz Guerrero
//* Fecha act.: Diciembre 2024
//* @Derechos reservados. Gobierno del Estado de México

// ***************************

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\si_prereg;
use App\Models\si_reg_forms;
use App\Models\si_ctrlLista;

use Log;

class oRegEstudiosController extends Controller
{
    
    protected $curp,
              $id,
              $folio_asignado;
    //Respuestas - Formato mujeres con bienestar
    protected 
            $zona,
            $empleo_formal,
            $ingresos_mensuales,
            $seguro_social,
            $bnf_programa,
            $b_programa,
            $parentesco,
            $otro_parentesco,
            $casa,
            $cuartos, 
            $personas,
            $tipo_material_paredes,
            $servicios,
            $estudios, 
            $otro_estudio, 
            $actual_estudio,
            $actual_otro_estudio,
            $falta_comida, 
            $jefa_familia,
            $afroamericana,
            $discapacidad,
            $victima,
            $indigena,
            $enfermedad,
            $cuida_personas,
            $repatriada,
            $situacion_pobreza;


    // *****************************************

        //Control y manejo de errores

            // 50000 - Datos de formulario exitoso - Datos generales
            // 50001 - Error de validación         - Reglas de modificación de datos generales
            // 50002 - Error de objeto            - Validación de datos generales
            // 50003 - Error de actualización       - Datos generales - Tabla de lista de espera
            // 50004 - Error de actualización       - Datos generales - Tabla de lista de asignación y control de folios
            // 50005 - Error de actualización       - Datos generales - Tabla de lista de beneficiarios - programa
            // 50006 - Error de actualización       - Datos generales - Tabla de preregistro - programa
            // 50006 - Error de actualización       - Datos generales - Tabla de preregistro - programa
            // 50007 - Error de actualización       - Datos generales - La función falló
            // 50008 - Error de actualización       - Datos domiciliarios
            // 50011 - Error al crear el folio      - La sentencia no fué ejecutada
            // 50012 - Error al crear el folio      - La actualización de folio falló
            // 50013 - Error al crear el folio      - La actualización de folio falló
            

    // *****************************************


    
    public function onUpdateFormMujeres(Request $request){

        $actual = new DateTime();
        $actual -> setTimeZone(new DateTimeZone("America/Monterrey"));
        $formato = $actual -> format('d/m/Y h:i A');

        $getForm  = $request -> data;
        $responseFunction = [];

       $responseFunction =  $this -> RulesMujeresForm($getForm);

       if(is_array($responseFunction) && array_key_exists('success', $responseFunction)){
        
        $getFlag = $responseFunction['success'];
            if(!$getFlag){
                
                return response() -> json($responseFunction);

            }else{
                
                $this -> id             = $getForm['id'];
                $this -> folio_asignado = $getForm['folio_asignado'];
                $this -> curp           = $getForm['curp'];
                            $this -> zona                   = $getForm['zona'];
                            $this -> empleo_formal          = $getForm['empleo_formal'];
                            $this -> ingresos_mensuales     = $getForm['ingresos_mensuales'];
                            $this -> seguro_social          = $getForm['seguro_social'];
                            $this -> bnf_programa           = $getForm['bnf_programa'];
                            $this -> b_programa             = $getForm['b_programa'];
                            $this -> parentesco             = $getForm['parentesco'];
                            $this -> otro_parentesco        = $getForm['otro_parentesco'];
                            $this -> casa                   = $getForm['casa'];
                            $this -> cuartos                = $getForm['cuartos']; 
                            $this -> personas               = $getForm['personas'];
                            $this -> tipo_material_paredes  = $getForm['tipo_material_paredes'];
                            $this -> servicios              = $getForm['servicios'];
                            $this -> estudios               = $getForm['estudios']; 
                            $this -> otro_estudio           = $getForm['otro_estudio']; 
                            $this -> actual_estudio         = $getForm['actual_estudio'];
                            $this -> actual_otro_estudio    = $getForm['actual_otro_estudio'];
                            $this -> falta_comida           = $getForm['falta_comida']; 
                            $this -> jefa_familia           = $getForm['jefa_familia'];
                            $this -> afroamericana          = $getForm['afroamericana'];
                            $this -> discapacidad           = $getForm['discapacidad'];
                            $this -> victima                = $getForm['victima'];
                            $this -> indigena               = $getForm['indigena'];
                            $this -> enfermedad             = $getForm['enfermedad'];
                            $this -> cuida_personas         = $getForm['cuida_personas'];
                            $this -> repatriada             = $getForm['repatriada'];
                            $this -> situacion_pobreza      = $getForm['situacion_pobreza'];


                $getEstadoFolio = si_ctrlLista::select('no_status')->where('curp', $getForm['curp'])->first();


                if(!empty($getEstadoFolio) || !is_null($getEstadoFolio) ){

                    try{

                        DB::beginTransaction();

                        $onUpdateForm = si_reg_forms::where('id', $this -> id)
                            ->where('curp', $this -> curp)
                            ->update([
                                'motivo'  => $this -> motivo,
                                'zona'                   => $this -> zona,
                                'empleo_formal'          => $this -> empleo_formal,
                                'ingresos_mensuales'     => $this -> ingresos_mensuales,
                                'seguro_social'          => $this -> seguro_social,
                                'bnf_programa'           => $this -> bnf_programa,
                                'b_programa'             => $this -> b_programa,
                                'parentesco'             => $this -> parentesco,
                                'otro_parentesco'        => $this -> otro_parentesco,
                                'casa'                   => $this -> casa,
                                'cuartos'                => $this -> cuartos,
                                'personas'               => $this -> personas,
                                'tipo_material_paredes'  => $this -> tipo_material_paredes,
                                'servicios'              => $this -> servicios,
                                'estudios'               => $this -> estudios,
                                'otro_estudio'           => $this -> otro_estudio,
                                'actual_estudio'         => $this -> actual_estudio,
                                'actual_otro_estudio'    => $this -> actual_otro_estudio,
                                'falta_comida'           => $this -> falta_comida,
                                'jefa_familia'           => $this -> jefa_familia,
                                'afroamericana'          => $this -> afroamericana,
                                'discapacidad'           => $this -> discapacidad,
                                'victima'                => $this -> victima,
                                'indigena'               => $this -> indigena,
                                'enfermedad'             => $this -> enfermedad,
                                'cuida_personas'         => $this -> cuida_personas,
                                'repatriada'             => $this -> repatriada,
                                'situacion_pobreza'      => $this -> situacion_pobreza,
                                    ]);

                    if($onUpdateForm <= 0 || $onUpdateForm > 1){
                        DB::rollback();

                        return response() -> json([
                            'success' => false,
                            'message' => '50009',
                            'error'   => 'Actualización de datos',
                            'data'    => []
                        ], 500);

                    }else{

                      

                                $onUpdateFolioRel = si_prereg::where('id', $this -> id)
                                    ->where('curp', $this -> curp)
                                    ->update([
                                        'fecha_solicitud' => $formato
                                    ]);

                                if($onUpdateFolioRel <= 0 || $onUpdateFolioRel > 1){

                                    return response() -> json([
                                        'success' => false,
                                        'message' => '50012',
                                        'error'   => 'Actualización de datos',
                                        'data'    => []
                                    ], 500);

                                }else{
                                    $onUpdateTerminoRel = si_ctrlList::where('id', $this -> id)
                                            ->where('curp', $this -> curp)
                                            ->update([
                                                'estado_registro' => 1
                                            ]);

                                        if($onUpdateTerminoRel <= 0 || $onUpdateTerminoRel > 1){

                                            return response() -> json([
                                                'success' => false,
                                                'message' => '50013',
                                                'error'   => 'Actualización de datos',
                                                'data'    => []
                                            ], 500);

                                        }
                                }

                            

                        DB::commit();

                            return response() -> json([
                                'success' => true,
                                'message' => '50000',
                                'error'   => 'Actualización de datos',
                                'data'    => [$this -> folio_asignado]
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

    }
}

    public function RulesMujeresForm($dataForm){


    $info = $dataForm;

    try{

        $rules = [
        'zona'               => 'required|numeric',
        'jefa_familia'       => 'required|numeric',
        'empleo_formal'      => 'required|numeric',
        'ingresos_mensuales' => 'required|numeric',
        'seguro_social'      => 'required|numeric',
        'bnf_programa'       => 'required|numeric',
        'b_programa'         => 'string|max:100',
        'parentesco'         => 'required|string',
        'otro_parentesco'    => 'string|max:100',
        'casa'               => 'required',
        'cuartos'            => 'required',
        'personas'           => 'required',
        'tipo_material_paredes' => 'string|max:100',
        'servicios'          => 'required|string',
        'estudios'           => 'required',
        'otro_estudio'       => 'string|max:100',
        'actual_estudio'     => 'required',
        'actual_otro_estudio' => 'required',
        'indigena'           => 'required',
        'afromexicana'       => 'required',
        'enfermedad'         => 'required',
        'discapacidad'       => 'required',
        'cuida_personas'     => 'required',
        'victima'            => 'required',
        'repatriada'         => 'required',
        'situacion_pobreza'  => 'required'
        ];

        $messages = [

            'required'    => 'Campo obligatorio',
            'date'        => 'El campo debe ser tipo fecha',
            'date_format' => 'El campo no tiene el formato requerido',
            'numeric'     => 'El campo debe ser númerico',
            'max'         => 'Máximo de caracteres',
            'string'      => 'El campo debe ser un texto válido'

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

    }catch(Exception $error){

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
