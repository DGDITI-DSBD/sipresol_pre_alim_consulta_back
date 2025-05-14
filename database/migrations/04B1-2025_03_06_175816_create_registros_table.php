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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programa_id');
            $table->unsignedBigInteger('apoyo_id')->nullable();
            $table->unsignedBigInteger('calendario_id')->nullable();
            $table->string('folio_solicitud')->unique();

            $table->date('fecha_solicitud')->nullable();
            
            $table->integer('estado_validacion_renapo')->integer()->default(100);
            $table->date('fecha_validacion_renapo')->date()->nullable();
            $table->integer('estado_solicitud')->default(100);
            $table->string('estado_beneficiario')->default(100);
            $table->integer('cedis_id')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->string('motivo_baja')->nullable();
            //$table->boolean('es_beneficiario')->default(false);
            
            // Metadatos
            $table->string('folio_relacionado')->nullable();
            $table->date('fecha_ingreso_programa')->nullable();
            $table->string('primer_ap');
            $table->string('segundo_ap')->nullable();
            $table->string('nombres');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('genero');
            $table->integer('ct_edo_civil');
            $table->integer('ct_escolaridad')->nullable();
            $table->integer('tp_id_oficial');
            $table->string('id_oficial');
            $table->integer('ct_ent_nac');
            $table->string('curp');
            $table->string('calle');
            $table->string('num_ext');
            $table->string('num_int')->nullable();
            $table->string('entre_calle')->nullable();
            $table->string('y_calle')->nullable();
            $table->string('otra_referencia')->nullable();
            $table->string('colonia');
            $table->integer('ct_localidad');
            $table->string('localidad');
            $table->integer('ct_municipio');
            $table->string('municipio');
            $table->integer('ct_entidad_federativa');
            $table->string('entidad_federativa');
            $table->integer('codigo_postal_id');
            $table->string('codigo_postal');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();

            $table->uuid('uuid')->unique();
            
            $table->timestamps();

            // Relaciones
            $table->foreign('programa_id')
                ->references('id')
                ->on('cat_programas')
                ->onDelete('cascade');
                
            $table->foreign('apoyo_id')
                ->references('id')
                ->on('cat_apoyos')
                ->onDelete('set null');
                
            $table->foreign('calendario_id')
                ->references('id')
                ->on('cat_calendarios')
                ->onDelete('set null');
            
            $table->foreign('cedis_id')
                ->references('id')
                ->on('cat_cedis')
                ->onDelete('set null');

            $table->foreign('ct_edo_civil')
                ->references('id')
                ->on('cat_edo_civil')
                ->onDelete('set null');
            
            $table->foreign('ct_escolaridad')
                  ->references('id')
                  ->on('cat_escolaridad')
                  ->onDelete('set null');

            $table->foreign('tp_id_oficial')
                ->references('id')
                ->on('cat_id_oficial')
                ->onDelete('set null');
            
            $table->foreign('ct_ent_nac')
                ->references('id')
                ->on('cat_entidad_federativa')
                ->delete('set null');

            $table->foreign('ct_entidad_federativa')
                ->references('id')
                ->on('cat_entidad_federativa')
                ->delete('set null');

            $table->foreign('ct_municipio')
                ->references('id')
                ->on('cat_municipios')
                ->delete('set null');

            $table->foreign(['ct_municipio', 'ct_localidad'])
                ->references(['municipio_id', 'cve_localidad'])
                ->on('cat_localidades')
                ->delete('set null');

            $table->foreign(['ct_municipio', 'codigo_postal_id'])
                ->references(['municipio_id', 'asentamiento_id'])
                ->on('cat_codigos_postales')
                ->delete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};