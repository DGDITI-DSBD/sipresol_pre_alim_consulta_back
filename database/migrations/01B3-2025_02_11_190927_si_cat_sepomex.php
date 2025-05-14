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
        Schema::create('cat_codigos_postales', function(Blueprint $table){

            $table -> id();
            $table -> string('codigo_postal');
            $table -> integer('asentamiento_id');
            $table -> string('asentamiento');
            $table -> integer('municipio_id');
            $table -> string('municipio');
            $table -> unique(['municipio_id','asentamiento_id']);
            $table -> integer('anio');

            $table->foreign('municipio_id')
            ->references('id')
            ->on('cat_municipios')
            ->onDelete('set null');
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
