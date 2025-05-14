<?php

namespace Database\Seeders;

use App\Models\Programa\Opcion;
use App\Models\Programa\Pregunta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpcionesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Primero, limpiar la tabla para evitar duplicados
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('imevis_cat_opciones')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Definir opciones para diferentes tipos de preguntas
        $p1 = [
            ['pregunta_id' => 1, 'texto' => 'Zona urbana', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 1, 'texto' => 'Zona rural', 'valor' => 2, 'deleted_at' => null],
        ];
        $p2 = [
            ['pregunta_id' => 2, 'texto' => 'Si', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 2, 'texto' => 'No', 'valor' => 2, 'deleted_at' => null],
        ];
        $p3 = [
            ['pregunta_id' => 3, 'texto' => 'Ninguno', 'valor' => 6, 'deleted_at' => null],
            ['pregunta_id' => 3, 'texto' => 'De $1 a $500', 'valor' => 5, 'deleted_at' => null],
            ['pregunta_id' => 3, 'texto' => 'De $501 a $1,000', 'valor' => 4, 'deleted_at' => null],
            ['pregunta_id' => 3, 'texto' => 'De $1,001 a $1,500', 'valor' => 3, 'deleted_at' => null],
            ['pregunta_id' => 3, 'texto' => 'De $1,501 a $2,000', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 3, 'texto' => 'Más de $2,000', 'valor' => 1, 'deleted_at' => null],           
        ];

        $p6 = [
            ['pregunta_id' => 6, 'texto' => 'Cónyuge', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Nuera', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Hijas(os)', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Yerno', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Padres', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Suegra(o)', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Hermanas(os)', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Nietas(os)', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Sobrinas(os)', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Sin parentesco', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Abuelas(os)', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 6, 'texto' => 'Otro', 'valor' => 0, 'deleted_at' => null],
        ];

        $p8 = [
            ['pregunta_id' => 8, 'texto' => 'Propia', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 8, 'texto' => 'Rentada', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 8, 'texto' => 'Prestada', 'valor' => 3, 'deleted_at' => null],
            ['pregunta_id' => 8, 'texto' => 'La estoy pagando', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 8, 'texto' => 'Otra', 'valor' => 0, 'deleted_at' => null],
        ];

        $p10 = [
            ['pregunta_id' => 10, 'texto' => 'Dos', 'valor' => 3, 'deleted_at' => null],
            ['pregunta_id' => 10, 'texto' => 'Tres', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 10, 'texto' => 'Más de cuatro', 'valor' => 1, 'deleted_at' => null],           
        ];
        $p11 = [
            ['pregunta_id' => 11, 'texto' => 'Dos', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 11, 'texto' => 'Tres', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 11, 'texto' => 'Más de cuatro', 'valor' => 3, 'deleted_at' => null],           
        ];

        $p12 = [
            ['pregunta_id' => 12, 'texto' => 'Tierra', 'valor' => 3, 'deleted_at' => null],
            ['pregunta_id' => 12, 'texto' => 'Cemento', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 12, 'texto' => 'Materiales de desecho', 'valor' => 2, 'deleted_at' => null],
        ];
        $p13 = [
            ['pregunta_id' => 13, 'texto' => 'Lámina', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 13, 'texto' => 'Cemento', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 13, 'texto' => 'Materiales de desecho', 'valor' => 3, 'deleted_at' => null],
        ];
        $p14 = [
            ['pregunta_id' => 14, 'texto' => 'Lámina', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 14, 'texto' => 'Cemento', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 14, 'texto' => 'Materiales de desecho', 'valor' => 3, 'deleted_at' => null],
        ];


        $p15 = [
            ['pregunta_id' => 15, 'texto' => 'Luz', 'valor' => -1, 'deleted_at' => null],
            ['pregunta_id' => 15, 'texto' => 'Agua', 'valor' => -1, 'deleted_at' => null],
            ['pregunta_id' => 15, 'texto' => 'Drenaje', 'valor' => -1, 'deleted_at' => null],
            ['pregunta_id' => 15, 'texto' => 'Gas', 'valor' => -1, 'deleted_at' => null],
        ];
        $p16 = [
            ['pregunta_id' => 16, 'texto' => 'Primaria', 'valor' => 4, 'deleted_at' => null],
            ['pregunta_id' => 16, 'texto' => 'Secundaria', 'valor' => 3, 'deleted_at' => null],
            ['pregunta_id' => 16, 'texto' => 'Preparatoria o bachillerato', 'valor' => 2, 'deleted_at' => null],
            ['pregunta_id' => 16, 'texto' => 'Licenciatura', 'valor' => 1, 'deleted_at' => null],
            ['pregunta_id' => 16, 'texto' => 'Postgrado', 'valor' => 0, 'deleted_at' => null],
            ['pregunta_id' => 16, 'texto' => 'Otro', 'valor' => 0, 'deleted_at' => null],
        ];


        
        // Combinar todos los arreglos de opciones
        $todasLasOpciones = array_merge(
            $p1,
            $p2,
            $p3,
            $p6,           
            $p8,          
            $p10,
            $p11,
            $p12,
            $p13,
            $p14,
            $p15,
            $p16,
        );

        // Insertar todas las opciones en la base de datos
        DB::table('cat_opciones')->insert($todasLasOpciones);

        $this->command->info('Opciones de preguntas insertadas correctamente');
    }
}
