<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Programa\Programa;

class ProgramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programas = [
            [
                'r_secretaria' => 'Secretaría de Bienestar',
                'organismo_ejecutor' => '',
                'unidad_ejecutora' => 'Dirección de Vivienda',
                'nombre_del_programa' => 'Alimentación para el Bienestar',
                'vertiente' => 'Carencia alimentaria',
                'anio' => 2025,
                'periodicidad' => 'Anual',
                'trimestre' => '1',
                'edad_min' => '50',
                'edad_max' => '64',
                'generos' => 'Mujer',
                'estado'   => true,
                'tiene_cobeneficiario' => false,
                'grupo_vuln_poblacion_atendida' => 'Población en vulnerabilidad',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('cat_programas')->insert($programas);
    }
}