<?php


// ***************************

//* File:       oConsultaEstadoController.php
//* Función:    Consulta de estado de proceso de aceptación al programa de gobierno
//* Autor:      Ing. Bruno Esteban Martinez Millán
//* Modificó:   Ing. Bruno Esteban Martinez Millán, Ing. Miguel Angel Torres Sanchez
//* Fecha act.: Diciembre 2024
//* @Derechos reservados. Gobierno del Estado de México

// ***************************


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class oConsultaEstadoController extends Controller
{
    

    public function generarFub(Request $request){

        $curp = $request -> curp;

        //Encuentre el registro de ctrl_lista y su preregistro y estudio relacionado
        $datosBeneficiaria = si_ctrlLista::with("preregistro")
                                        ->with("estudio")
                                        ->where("curp",$curp)
                                        ->first();

        //Si el cliente no existe en la tabla ctrl_lista
        if(!empty($datosBeneficiaria) || !is_null($datosBeneficiaria)){

            //Si el cliente existe en la tabla ctrl_lista
            $success = true;
            $message = '1';
            $error   = 'S/D';
            //$data    = $datosBeneficiaria;
            //separa la data en lista, preregistro y estudio
            $lista = $datosBeneficiaria->toArray();
            unset($lista['preregistro']);
            unset($lista['estudio']); 

            $preregistro = $datosBeneficiaria->preregistro ? 
                $datosBeneficiaria->preregistro->toArray() : [];

            $estudio = $datosBeneficiaria->estudio ? 
                $datosBeneficiaria->estudio->toArray() : [];

            $data = [
                'lista' => $lista,
                'preregistro' => $preregistro,  
                'estudio' => $estudio
            ];

        }else{
            
            //Si el cliente no existe en la tabla ctrl_lista
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
    }

}
