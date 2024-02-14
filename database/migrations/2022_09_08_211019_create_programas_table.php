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
        Schema::create('programas', function (Blueprint $table) {
          //$table->id();
          $table->String('cve_dependencia')->references('cve_dependencia')->on('dependencias')->onDelete('restrict')->onUpdate('cascade');
          $table->String('cve_programa')->primary();
          $table->String('programa');
          $table->timestamps();
          $table->foreign('cve_dependencia')->references('cve_dependencia')->on('dependencias')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
