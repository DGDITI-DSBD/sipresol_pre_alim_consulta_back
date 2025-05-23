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
        Schema::create('cat_opciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pregunta_id')
                ->constrained('cat_preguntas')
                ->cascadeOnDelete();
            $table->string('texto');
            $table->integer('valor');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_opciones');
    }
};
