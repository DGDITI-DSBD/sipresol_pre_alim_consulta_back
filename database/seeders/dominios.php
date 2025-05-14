<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\si_cat_dominios;

class dominios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id_sigesp"=> 0,
                "dominio_mail"=> "SIN ESPECIFICAR",
                "no_status"=> 0
            ],
            [
                "id_sigesp"=> 1,
                "dominio_mail"=> "@gmail.com",
                "no_status"=> 0
            ],
            [
                "id_sigesp"=> 2,
                "dominio_mail"=> "@hotmail.com",
                "no_status"=> 0
            ],
            [
                "id_sigesp"=> 3,
                "dominio_mail"=> "@live.com.mx",
                "no_status"=> 0
            ],
            [
                "id_sigesp"=> 4,
                "dominio_mail"=> "@outlook.com",
                "no_status"=> 0
            ],
            [
                "id_sigesp"=> 5,
                "dominio_mail"=> "@yahoo.com",
                "no_status"=> 0
            ]
            ];
            

            foreach($data as $key => $value){
                si_cat_dominios::create($value);
            }
        }
    }

