<?php

namespace App\Http\Controllers;

use App\Models\CedisCodigosPostales;
use Illuminate\Http\Request;

use App\Models\si_cat_entidad_federativa;
use App\Models\si_cat_localidades;
use App\Models\si_cat_municipios;
use App\Models\si_cat_nacionalidades;
use App\Models\si_cat_sepomex;

use App\Models\si_cat_documentos;
use App\Models\si_cat_estado_civil;
use App\Models\si_cat_dominios;
use App\Models\si_cat_grado_estudios;



class oCatalogosController extends Controller
{

    public function dominios()
    {

        $getDominios = si_cat_dominios::select('*')
            ->orderBy('id_sigesp', 'asc')
            ->get();

        return response()->json($getDominios);

    }

    public function documentos()
    {

        $docsOficiales = si_cat_documentos::select('*')
            ->orderBy('id_documento', 'asc')
            ->get();

        return response()->json($docsOficiales);

    }

    public function estados_civiles()
    {

        $getEdoCivil = si_cat_estado_civil::select('*')
            ->orderBy('cve_estado_civil', 'asc')
            ->get();

        return response()->json($getEdoCivil);

    }

    public function grado_estudios()
    {

        $getGrado = si_cat_grado_estudios::select('*')
            ->orderBy('cve_grado_estudio', 'asc')
            ->get();

        return response()->json($getGrado);

    }

    public function municipios()
    {

        $getCatFilMun = si_cat_municipios::select('entidadfederativaid', 'municipioid', 'municipionombre', 'gm_2020', 'regionid')
            ->where('entidadfederativaid', 15)
            ->orderBy('municipioid', 'asc')
            ->get();

        return response()->json($getCatFilMun);

    }

    public function localidades()
    {
        $getCatLocalidades = si_cat_localidades::select('cve_entidad_federativa', 'nom_ent', 'cve_municipio', 'nom_mun', 'cve_localidad', 'desc_localidad', 'lat_decimal', 'lon_decimal')
            ->where('cve_entidad_federativa', 15)
            ->orderBy('cve_localidad', 'asc')
            ->get();

        return response()->json($getCatLocalidades);
    }

    public function nacionalidades()
    {

        $getCatNac = si_cat_nacionalidades::select('*')
            ->orderBy('cve_pais', 'asc')
            ->get();

        return response()->json($getCatNac);
    }

    public function codigos_postales()
    {

        $getCodigosPostales = si_cat_sepomex::select('cve_ent_fed', 'cve_municipio', 'cp_sipo', 'desc_asenta', 'id_asenta_cpcons')
            ->where('cve_ent_fed', 15)
            ->orderBy('cve_municipio', 'asc')
            ->get();

        return response()->json($getCodigosPostales);
    }


    public function getInitCatalogos()
    {

        $getDominios = si_cat_dominios::select('*')
            ->orderBy('id_sigesp', 'asc')
            ->get();

        $getEdoCivil = si_cat_estado_civil::select('*')
            ->orderBy('id', 'asc')
            ->get();

        $docsOficiales = si_cat_documentos::select('*')
            ->orderBy('id', 'asc')
            ->get();

        $getCatFilMun = si_cat_municipios::select('cve_municipio', 'municipio', 'region_id')
            ->where('entidad_federativa_id', 15)
            ->get();

        $getCatLocalidades = si_cat_localidades::select('id', 'municipio_id', 'cve_localidad', 'localidad', 'cve_localidad')
            ->where('anio', 2025)
            ->orderBy('municipio_id', 'asc')
            ->orderBy('cve_localidad', 'asc')
            ->get();
        $getCatCodigosPostales = si_cat_sepomex::select(
            'id',
            'codigo_postal',
            \DB::raw("concat_ws('-', codigo_postal, asentamiento) AS codigo_asentamiento"),
            'asentamiento_id',
            'asentamiento',
            'municipio_id',
            'municipio'
        )
            ->where('anio', 2025)
            ->orderBy('municipio_id', 'asc')
            ->orderBy('codigo_postal', 'asc')
            ->get();

        $getCedis_codigos_postales = CedisCodigosPostales::select('cedis_id', 'codigo_postal')
            ->with('datos_cedis')
            ->get();

        $get_grado_estudios = si_cat_grado_estudios::select('id','escolaridad')->where('anio',2025)->orderBy('id','asc')->get();

        return response()->json([
            'sucess' => true,
            'message' => 'Catálogos',
            'status' => 200,
            'data' => [
                'dominios' => $getDominios,
                'estadocivil' => $getEdoCivil,
                'docsoficiales' => $docsOficiales,
                'municipios' => $getCatFilMun,
                'localidades' => $getCatLocalidades,
                'codigos_postales' => $getCatCodigosPostales,
                'cedis_codigos_postales' => $getCedis_codigos_postales,
                'escolaridad' => $get_grado_estudios
            ]
        ]);
    }

    public function getFilterPerMunicipio()
    {

        $getCatFilMun = si_cat_municipios::select('municipioid', 'municipionombre', 'regionid')
            ->where('entidadfederativaid', 15)
            ->get();

        return response()->json([
            'sucess' => true,
            'message' => 'Catálogo de municipios',
            'status' => 200,
            'data' => $getCatFilMun
        ]);

    }

    public function getFilterPerLocalidad(Request $request)
    {


        $getMunicipio = $request->cve_municipio;

        $getCatLocalidad = si_cat_localidades::select('cve_localidad', 'desc_localidad')
            ->where('cve_entidad_federativa', 15)
            ->where('cve_municipio', $getMunicipio)
            ->orderBy('cve_municipio', 'desc')
            ->get();

        return response()->json([
            'sucess' => true,
            'message' => 'Catálogo de localidades',
            'status' => 200,
            'data' => $getCatLocalidad
        ]);

    }

    public function getFilterPerColoniaAndPostal(Request $request)
    {

        $getMunicipio = $request->cve_municipio;

        $getCatCodigos = si_cat_sepomex::select('id_asenta_cpcons', 'cp_sipo', 'desc_asenta')
            ->where('cve_municipio', $getMunicipio)
            ->orderBy('cve_municipio', 'desc')
            ->orderBy('id_asenta_cpcons', 'desc')
            ->get();

        return response()->json([
            'sucess' => true,
            'message' => 'Catálogo de codigos postales',
            'status' => 200,
            'data' => $getCatCodigos
        ]);

    }

}


