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
        Schema::create('cedis_codigos_postales', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_postal', 10);
            $table->unsignedBigInteger('cedis_id');
            $table->foreign('cedis_id')->references('id')->on('cat_cedis')->onDelete('cascade');
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
