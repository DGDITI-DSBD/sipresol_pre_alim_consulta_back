<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cat_programas', function (Blueprint $table) {
            $table->id();
            $table->string('r_secretaria');
            $table->string('organismo_ejecutor');
            $table->string('unidad_ejecutora');
            $table->string('nombre_del_programa');
            $table->string('vertiente');
            $table->integer('anio');
            $table->string('periodicidad');
            $table->string('trimestre');
            $table->string('grupo_vuln_poblacion_atendida');
            $table->integer('edad_min');
            $table->integer('edad_max');
            $table->string('generos');
            $table->boolean('estado');
            $table->boolean('tiene_cobeneficiario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_programas');
    }
};