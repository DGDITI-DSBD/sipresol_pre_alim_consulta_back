<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\si_cat_entidad_federativa;

class cat_entidad_federativa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
             ["entidad_federativa"=>"AGUASCALIENTES","abreviatura_entidad_federativa"=>"AS"]
            ,["entidad_federativa"=>"BAJA CALIFORNIA","abreviatura_entidad_federativa"=>"BC"]
            ,["entidad_federativa"=>"BAJA CALIFORNIA SUR","abreviatura_entidad_federativa"=>"BS"]
            ,["entidad_federativa"=>"CAMPECHE","abreviatura_entidad_federativa"=>"CC"]
            ,["entidad_federativa"=>"COAHUILA","abreviatura_entidad_federativa"=>"CL"]
            ,["entidad_federativa"=>"COLIMA","abreviatura_entidad_federativa"=>"CM"]
            ,["entidad_federativa"=>"CHIAPAS","abreviatura_entidad_federativa"=>"CS"]
            ,["entidad_federativa"=>"CHIHUAHUA","abreviatura_entidad_federativa"=>"CH"]
            ,["entidad_federativa"=>"DISTRITO FEDERAL","abreviatura_entidad_federativa"=>"DF"]
            ,["entidad_federativa"=>"DURANGO","abreviatura_entidad_federativa"=>"DG"]
            ,["entidad_federativa"=>"GUANAJUATO","abreviatura_entidad_federativa"=>"GT"]
            ,["entidad_federativa"=>"GUERRERO","abreviatura_entidad_federativa"=>"GR"]
            ,["entidad_federativa"=>"HIDALGO","abreviatura_entidad_federativa"=>"HG"]
            ,["entidad_federativa"=>"JALISCO","abreviatura_entidad_federativa"=>"JC"]
            ,["entidad_federativa"=>"ESTADO DE MEXICO","abreviatura_entidad_federativa"=>"MC"]
            ,["entidad_federativa"=>"MICHOACAN","abreviatura_entidad_federativa"=>"MN"]
            ,["entidad_federativa"=>"MORELOS","abreviatura_entidad_federativa"=>"MS"]
            ,["entidad_federativa"=>"NAYARIT","abreviatura_entidad_federativa"=>"NT"]
            ,["entidad_federativa"=>"NUEVO LEON","abreviatura_entidad_federativa"=>"NL"]
            ,["entidad_federativa"=>"OAXACA","abreviatura_entidad_federativa"=>"OC"]
            ,["entidad_federativa"=>"PUEBLA","abreviatura_entidad_federativa"=>"PL"]
            ,["entidad_federativa"=>"QUERETARO","abreviatura_entidad_federativa"=>"QT"]
            ,["entidad_federativa"=>"QUINTANA ROO","abreviatura_entidad_federativa"=>"QR"]
            ,["entidad_federativa"=>"SAN LUIS POTOSI","abreviatura_entidad_federativa"=>"SP"]
            ,["entidad_federativa"=>"SINALOA","abreviatura_entidad_federativa"=>"SL"]
            ,["entidad_federativa"=>"SONORA","abreviatura_entidad_federativa"=>"SR"]
            ,["entidad_federativa"=>"TABASCO","abreviatura_entidad_federativa"=>"TC"]
            ,["entidad_federativa"=>"TAMAULIPAS","abreviatura_entidad_federativa"=>"TS"]
            ,["entidad_federativa"=>"TLAXCALA","abreviatura_entidad_federativa"=>"TL"]
            ,["entidad_federativa"=>"VERACRUZ","abreviatura_entidad_federativa"=>"VZ"]
            ,["entidad_federativa"=>"YUCATAN","abreviatura_entidad_federativa"=>"YN"]
            ,["entidad_federativa"=>"ZACATECAS","abreviatura_entidad_federativa"=>"ZS"]
            ,["entidad_federativa"=>"NACIDO EN EL EXTRANJERO","abreviatura_entidad_federativa"=>"NE"]
        ];

        foreach($data as $key => $value){
            si_cat_entidad_federativa::create($value);
        }
    }
}
