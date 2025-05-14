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
        Schema::create('cat_calendarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programa_id');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('letras')->nullable();
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
        Schema::dropIfExists('cat_calendarios');
    }
};