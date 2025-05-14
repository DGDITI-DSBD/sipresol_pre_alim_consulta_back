<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\si_cat_grado_estudios;

class escolaridad extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1, 
                'escolaridad' => 'PREESCOLAR',
                'anio' => 2025,

            ],
            [
                'id' => 2, 
                'escolaridad' => 'PRIMARIA',
                'anio' => 2025,

            ],
            [
                'id' => 3, 
                'escolaridad' => 'SECUNDARIA',
                'anio' => 2025,

            ],
            [
                'id' => 4, 
                'escolaridad' => 'BACHILLERATO, PREPARATORIA O EQUIVALENTE',
                'anio' => 2025,

            ],
            [
                'id' => 5, 
                'escolaridad' => 'LICENCIATURA O EQUIVALENTE',
                'anio' => 2025,

            ],
            [
                'id' => 6, 
                'escolaridad' => 'TÉCNICO',
                'anio' => 2025,

            ],
            [
                'id' => 7, 
                'escolaridad' => 'MAESTRÍA',
                'anio' => 2025,

            ],
            [
                'id' => 8, 
                'escolaridad' => 'DOCTORADO',
                'anio' => 2025,

            ],
        ];

        foreach($data as $key => $value){
            si_cat_grado_estudios::create($value);
        }
    }
}
