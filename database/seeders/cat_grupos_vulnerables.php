<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Catalogos\GrupoVulnerado;

class cat_grupos_vulnerables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'grupo' => 'ADULTOS',
                'caracteristicas' => 'MUJERES, HOMBRES MENORES DE 60 AÑOS'
            ],
            [
                'grupo' => 'ADULTOS MAYORES',
                'caracteristicas' => 'MUJERES, HOMBRES MAYORES DE 60 AÑOS'
            ],
            [
                'grupo' => 'NIÑOS',
                'caracteristicas' => '0 A 12 AÑOS'
            ],
            [
                'grupo' => 'JOVENES',
                'caracteristicas' => '12 AÑOS UN MES Y HASTA 18 AÑOS'
            ],
            [
                'grupo' => 'ESTUDIANTES (MAYORES 18 AÑOS)',
                'caracteristicas' => 'MUJERES, HOMBRES MENORES DE 60 AÑOS'
            ],
            [
                'grupo' => 'INDIGENAS',
                'caracteristicas' => 'ORIGINARIOS DE ALGUNA DE LA ETNIAS HABITANTES DEL ESTADO DE MÉXICO'
            ],
            [
                'grupo' => 'FAMILIAS',
                'caracteristicas' => 'QUE POR SU CONDICIÓN O MARGINACIÓN REQUIERAN APOYOS'
            ],
            [
                'grupo' => 'PRODUCTORES ORGANIZADOS (GRUPOS)',
                'caracteristicas' => 'GRUPOS ORGANIZADOS DE PERSONAS QUE POR SU ACTIVIDAD REQUIERAN DE APOYOS PARA EL DESARROLLO DE ACTIVIDADES PRODUCTIVAS'
            ]
        ];

        foreach($data as $key => $value){
            GrupoVulnerado::create($value);
        }


    }
}
