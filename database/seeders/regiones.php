<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catalogos\Regiones as cat_regiones;

class regiones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
             ["region_id"=>1,"descripcion"=>"AMECAMECA "]
            ,["region_id"=>2,"descripcion"=>"ATLACOMULCO"]
            ,["region_id"=>3,"descripcion"=>"CHIMALHUACAN"]
            ,["region_id"=>4,"descripcion"=>"CUAUTITLAN IZCALLI"]
            ,["region_id"=>5,"descripcion"=>"ECATEPEC "]
            ,["region_id"=>6,"descripcion"=>"IXTLAHUACA"]
            ,["region_id"=>7,"descripcion"=>"LERMA"]
            ,["region_id"=>8,"descripcion"=>"METEPEC"]
            ,["region_id"=>9,"descripcion"=>"NAUCALPAN"]
            ,["region_id"=>10,"descripcion"=>"NEZAHUALCOYOTL"]
            ,["region_id"=>11,"descripcion"=>"OTUMBA"]
            ,["region_id"=>12,"descripcion"=>"TEJUPILCO"]
            ,["region_id"=>13,"descripcion"=>"TENANCINGO"]
            ,["region_id"=>14,"descripcion"=>"TEPOTZOTLAN"]
            ,["region_id"=>15,"descripcion"=>"TEXCOCO"]
            ,["region_id"=>16,"descripcion"=>"TLALNEPANTLA"]
            ,["region_id"=>17,"descripcion"=>"TOLUCA"]
            ,["region_id"=>18,"descripcion"=>"TULTITLAN"]
            ,["region_id"=>19,"descripcion"=>"VALLE DE BRAVO"]
            ,["region_id"=>20,"descripcion"=>"ZUMPANGO"]
        ];

        foreach($data as $key => $value){
            cat_regiones::create($value);
        }

    }
}
