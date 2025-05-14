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
        Schema::create('padron_historico', function (Blueprint $table) {
            $table->id();
            $table->string('curp', 18);
            $table->string('primer_ap');
            $table->string('segundo_ap')->nullable();
            $table->string('nombres');
            $table->integer('cve_municipio');
            $table->string('municipio');
            $table->string('folio_relacionado');
            $table->timestamps();
            
            // Índice para búsquedas rápidas por CURP
            $table->index('curp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padron_historico');
    }
};