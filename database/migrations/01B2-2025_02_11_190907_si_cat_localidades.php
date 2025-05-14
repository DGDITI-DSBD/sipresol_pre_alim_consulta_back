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
        Schema::create('cat_localidades', function(Blueprint $table){

            $table -> id();
            $table -> integer('municipio_id');
            $table -> integer('cve_localidad');
            $table -> unique(['municipio_id', 'cve_localidad']);
            $table -> string('localidad');
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
