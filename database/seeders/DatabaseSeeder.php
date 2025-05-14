<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this -> call([
            cat_entidad_federativa::class,
            regiones::class,
            cat_municipios::class,
            cat_localidades::class,
            cat_codigos_postales::class,
            cedis::class,
            documentos::class,
            dominios::class,
            estados_civiles::class,
            nacionalidades::class,
            ProgramasSeeder::class,
            PreguntasTableSeeder::class,
            OpcionesSeeders::class,
            cedis_codigos_postales::class,
            calendarios_seeder::class,
            apoyos_seeder::class,
            escolaridad::class,
        ]);
    }
}
