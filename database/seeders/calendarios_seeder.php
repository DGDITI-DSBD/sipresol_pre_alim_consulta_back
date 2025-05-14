<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class calendarios_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_calendarios')->insert([
            [
                'programa_id' => 1,
                'fecha_inicio' => '2025-05-12',
                'fecha_fin' => '2025-05-12',
                'letras'=>'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'programa_id' => 1,
                'fecha_inicio' => '2025-05-13',
                'fecha_fin' => '2025-05-14',
                'letras'=>'A,B,C,D,E,F,G',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'programa_id' => 1,
                'fecha_inicio' => '2025-05-15',
                'fecha_fin' => '2025-05-16',
                'letras'=>'H,I,J,K,L,M,N',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'programa_id' => 1,
                'fecha_inicio' => '2025-05-17',
                'fecha_fin' => '2025-05-18',
                'letras'=>'O,P,Q,R,S,T',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'programa_id' => 1,
                'fecha_inicio' => '2025-05-19',
                'fecha_fin' => '2025-05-20',
                'letras'=>'U,V,W,X,Y,Z',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}