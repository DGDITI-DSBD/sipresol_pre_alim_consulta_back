<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class apoyos_seeder extends Seeder
{
    public function run()
    {
        DB::table("cat_apoyos")->insert([
            [
                "programa_id" => 1,
                "tipo_apoyo" => "especies",
                "nombre" => "Canasta Alimentaria",
                "descripcion" => "Canasta Alimentaria Básica",
                "costo_unitario" => "605.00",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);

    }
}