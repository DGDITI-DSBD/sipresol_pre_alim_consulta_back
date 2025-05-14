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
        Schema::create('cat_municipios', function(Blueprint $table){

            $table -> id();
            $table -> integer('entidad_federativa_id');
            $table -> integer('cve_municipio');
            $table -> string('municipio');
            $table -> integer('region_id');

            $table->foreign('region_id')
            ->references('id')
            ->on('cat_regiones')
            ->onDelete('set null');
    
            $table->foreign('entidad_federativa_id')
            ->references('id')
            ->on('cat_entidad_federativa')
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
