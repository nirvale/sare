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
        Schema::create('procesadores', function (Blueprint $table) {
            $table->id();
            $table->string('procesador')->unique();
            $table->integer('nucleos');
            $table->string('velocidad');
            $table->integer('cve_mprocesador');
            $table->integer('cve_aprocesador');
            $table->timestamps();
            $table->foreign('cve_aprocesador')->references('id')->on('aprocesadores')->onUpdate('cascade');
            $table->foreign('cve_mprocesador')->references('id')->on('mprocesadores')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesadors');
    }
};
