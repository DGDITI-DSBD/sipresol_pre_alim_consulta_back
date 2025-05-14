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
        Schema::create('si_ctrl_prereg', function(Blueprint $table){
            $table -> id();
            $table -> unsignedBigInteger('si_ctrl_lista_id');
            $table -> integer('cve_tipo_id_ofl')->nullable();
            $table -> string('id_docto_ofl')->nullable();
            $table -> integer('ct_edo_civil')->nullable();
            $table -> integer('grupo_vuln_poblacion_atendida')->nullable();
            $table -> string('calle')->nullable();
            $table -> string('num_ext')->nullable();
            $table -> string('num_int')->nullable();
            $table -> string('entre_calle')->nullable();
            $table -> string('y_calle')->nullable();
            $table -> string('otra_referencia')->nullable();
            $table -> integer('cve_asentamiento')->nullable();
            $table -> string('colonia')->nullable(); // Mostrar en catalogo -> hasOne
            $table -> integer('cve_localidad')->nullable();
            $table -> string('localidad')->nullable();
            $table -> integer('cve_municipio')->nullable();
            $table -> string('municipio')->nullable();
            $table -> integer('cve_entidad_federativa')->nullable();
            $table -> string('entidad_federativa')->nullable();
            $table -> string('codigo_postal')->nullable();
            $table -> string('telefono')->nullable();
            $table -> string('telefono_fijo')->nullable();
            $table -> string('email')->nullable();
            $table -> integer('cve_region')->nullable();
            $table -> string('fecha_registro')->nullable();
            $table -> string('fecha_solicitud')->nullable(); // hh/mm dd/mm/yy
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
