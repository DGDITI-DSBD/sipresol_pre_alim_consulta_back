<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('respuestas_opciones', function (Blueprint $table) {
            $table->foreignId('respuesta_id')
                ->constrained('respuestas')
                ->cascadeOnDelete();
            $table->foreignId('opcion_id')
                ->constrained('cat_opciones')
                ->cascadeOnDelete();
            $table->integer('cantidad')->nullable();
            $table->primary(['respuesta_id', 'opcion_id']);
        });
    }
};
