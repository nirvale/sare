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
        Schema::create('storageremotos', function (Blueprint $table) {
            $table->id();
            $table->string('storageremoto')->unique();
            $table->integer('cve_tecremotadisco');
            $table->integer('cve_mhardware');
            $table->integer('capacidad');
            $table->integer('usado');
            $table->float('disponible',4,2);
            $table->timestamps();
            $table->foreign('cve_tecremotadisco')->references('id')->on('tecremotadiscos')->onUpdate('cascade');
            $table->foreign('cve_mhardware')->references('id')->on('mhardwares')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storageremotos');
    }
};
