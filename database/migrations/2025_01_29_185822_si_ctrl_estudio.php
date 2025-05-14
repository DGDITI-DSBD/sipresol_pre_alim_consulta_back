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
        Schema::create('si_ctrl_estudio', function(Blueprint $table){
            $table -> id();
            $table -> unsignedBigInteger('si_ctrl_lista_id');
            $table -> integer('zona')->nullable();
            $table -> integer('empleo_formal')->nullable();
            $table -> integer('ingresos_mensuales')->nullable();
            $table -> integer('seguro_social')->nullable();
            $table -> integer('bnf_programa')->nullable();
            $table -> string('b_programa')->nullable();
            $table -> string('parentesco', 500)->nullable();
            $table -> string('otro_parentesco')->nullable();
            $table -> integer('casa')->nullable();
            $table -> integer('cuartos')->nullable(); 
            $table -> integer('personas')->nullable();
            $table -> integer('tipo_material_paredes')->nullable();
            $table -> integer('servicios')->nullable();
            $table -> integer('estudios')->nullable(); // binario
            $table -> string('otro_estudio')->nullable(); //catalogo de grado de estudio
            $table -> integer('actual_estudio')->nullable();
            $table -> string('actual_otro_estudio')->nullable();
            $table -> integer('falta_comida')->nullable(); // si - no // 3.14 En los ultimos tres meses, por falta de dinero o recursos ¿solo comió una vez, o dejó de comer todo un día?
            $table -> integer('jefa_familia')->nullable();
            $table -> integer('afroamericana')->nullable();
            $table -> integer('discapacidad')->nullable();
            $table -> integer('victima')->nullable();
            $table -> integer('indigena')->nullable();
            $table -> integer('enfermedad')->nullable();
            $table -> integer('cuida_personas')->nullable();
            $table -> integer('repatriada')->nullable();
            $table -> integer('situacion_pobreza')->nullable();
            $table -> timestamps();

            $table -> foreign('si_ctrl_lista_id')
                   ->references('id')
                   ->on('si_ctrl_lista');
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
