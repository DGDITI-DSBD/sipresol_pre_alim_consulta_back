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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                ->constrained('registros')
                ->cascadeOnDelete();
            $table->foreignId('pregunta_id')
                ->constrained('cat_preguntas')
                ->cascadeOnDelete();
            $table->foreignId('respuesta_padre_id')
                ->nullable()
                ->constrained('respuestas')
                ->cascadeOnDelete();
            $table->text('respuesta_texto')->nullable();
            $table->boolean('respuesta_si_no')->nullable();
            $table->integer('respuesta_numero')->nullable();
            $table->integer('calificacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
