<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Eliminar la secuencia al revertir la migración
        DB::statement('DROP SEQUENCE IF EXISTS secuencia_folios_ab');
        // Crear una secuencia en PostgreSQL
        DB::statement('CREATE SEQUENCE secuencia_folios_ab START WITH 1 INCREMENT BY 1');
        
        DB::statement('DROP SEQUENCE IF EXISTS secuencia_folios_ab_permanencia');
        // Crear una secuencia en PostgreSQL
        DB::statement('CREATE SEQUENCE secuencia_folios_ab_permanencia START WITH 1 INCREMENT BY 1');
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
