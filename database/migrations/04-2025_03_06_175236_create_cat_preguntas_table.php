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
        Schema::create('cat_preguntas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programa_id');
            $table->string('numero_pregunta');
            $table->enum('tipo_pregunta', [
                'opcion_unica',
                'opcion_multiple',
                'cantidad_por_opcion',
                'si_no',
                'texto_libre',
                'numero'
            ]);
            $table->text('pregunta_descripcion');
            $table->boolean('requerido')->default(false);
            $table->boolean('activo')->default(true);
            $table->foreignId('depende_de')->nullable()
                ->constrained('cat_preguntas')->cascadeOnDelete();
            $table->json('depende_respuesta')->nullable();
            $table->timestamps();

            // Relación con la tabla de programas
            $table->foreign('programa_id')
                ->references('id')
                ->on('cat_programas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_preguntas');
    }
};
