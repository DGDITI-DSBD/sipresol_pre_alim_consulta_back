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
        Schema::create('cat_apoyos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programa_id');
            $table->string('tipo_apoyo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('costo_unitario', 10, 2)->default(0);
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
        Schema::dropIfExists('cat_apoyos');
    }
};
