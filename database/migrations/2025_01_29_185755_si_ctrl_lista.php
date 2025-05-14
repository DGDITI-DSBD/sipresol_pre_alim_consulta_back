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
        Schema::create('si_ctrl_lista', function(Blueprint $table){
            $table -> id();
            $table -> string('curp');
            $table -> string('primer_apellido');
            $table -> string('segundo_apellido');
            $table -> string('nombre');
            $table -> char('sexo');
            $table -> string('fecha_nacimiento');
            $table -> string('edad');
            $table -> integer('cve_entidad_nacimiento');
            $table -> integer('cve_nacionalidad');
            $table -> integer('estado_validado');   // 1 - RENAPO 2 - PADRON 3 - SIN VALIDAR
            $table -> integer('estado_verificado');  // 1 - VERIFICADO - NO VERIFICADO
            $table -> integer('estado_termino');   // 1 - FINALIZADO  - 2 - SIN FINALIZAR
            $table -> integer('estado_registro');   // 1 - ACEPTADO  - 2 - NO ACEPTADO 3 - EN PROCESO
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
