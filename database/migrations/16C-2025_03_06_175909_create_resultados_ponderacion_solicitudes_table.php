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
        Schema::create('resultados_ponderacion_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registro_id');
            $table->string('resultado');
            $table->text('observaciones')->nullable();
            
            // No timestamps ya que el modelo tiene $timestamps = false

            // Relación con la tabla de registros
            $table->foreign('registro_id')
                ->references('id')
                ->on('registros')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_ponderacion_solicitudes');
    }
};