<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\si_cat_estado_civil;

class estados_civiles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "estado_civil"=> "SOLTERO(A)",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "CASADO(A)",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "VIUDO(A)",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "DIVORCIADO(A)",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "UNION LIBRE",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "SEPARADO(A)",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "CONCUBINATO",
                "anio" => 2025
            ],
            [
                "estado_civil"=> "OTRO",
                "anio" => 2025
            ]
        ];

        foreach($data as $key => $value){
            si_cat_estado_civil::create($value);
        }

    }
}
