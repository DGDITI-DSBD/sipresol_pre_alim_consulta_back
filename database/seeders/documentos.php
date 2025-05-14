<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\si_cat_documentos;

class documentos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "anio"=> 2023,
                "id"=> 0,
                "tp_id_oficial"=> "NINGUNO",
                "no_status"=> "0"
            ],
            [
                "anio"=> 2023,
                "id"=> 1,
                "tp_id_oficial"=> "OTRO",
                "no_status"=> "0"
            ],
            [
                "anio"=> 2023,
                "id"=> 2,
                "tp_id_oficial"=> "CREDENCIAL INE",
                "no_status"=> "1"
            ],
            [
                "anio"=> 2023,
                "id"=> 3,
                "tp_id_oficial"=> "LICENCIA DE MANEJO",
                "no_status"=> "1"
            ],
            [
                "anio"=> 2023,
                "id"=> 4,
                "tp_id_oficial"=> "CARTILLA MILITAR",
                "no_status"=> "1"
            ],
            [
                "anio"=> 2023,
                "id"=> 5,
                "tp_id_oficial"=> "CREDENCIAL INAPAM",
                "no_status"=> "0"
            ],
            [
                "anio"=> 2023,
                "id"=> 6,
                "tp_id_oficial"=> "CREDENCIAL IMMS",
                "no_status"=> "0"
            ],
            [
                "anio"=> 2023,
                "id"=> 7,
                "tp_id_oficial"=> "CREDENCIAL ISSSTE",
                "no_status"=> "0"
            ],
            [
                "anio"=> 2023,
                "id"=> 8,
                "tp_id_oficial"=> "CREDENCIAL INSEN",
                "no_status"=> "0"
            ],
            [
                "anio"=> 2023,
                "id"=> 9,
                "tp_id_oficial"=> "PASAPORTE",
                "no_status"=> "1"
            ],
            [
                "anio"=> 2023,
                "id"=> 10,
                "tp_id_oficial"=> "RFC",
                "no_status"=> "1"
            ],
            [
                "anio"=> 2023,
                "id"=> 11,
                "tp_id_oficial"=> "CURP",
                "no_status"=> "1"
            ],
            [
                "anio"=> 2023,
                "id"=> 12,
                "tp_id_oficial"=> "ACTA DE NACIMIENTO",
                "no_status"=> "0"
            ]
        ];

        foreach($data as $key => $value){
            si_cat_documentos::create($value);
        }
    }
}
