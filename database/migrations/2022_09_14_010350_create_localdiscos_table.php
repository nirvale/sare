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
        Schema::create('localdiscos', function (Blueprint $table) {
          $table->id();
          $table->integer('cve_servidor');
          $table->string('disco');
          $table->string('pmontaje');
          $table->integer('cve_dformato');
          $table->string('capacidad');
          $table->string('usado');
          $table->string('usadop');
          $table->text('comontaje');
          $table->text('descripcion');
          $table->timestamps();
          $table->foreign('cve_servidor')->references('id')->on('servidores')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('cve_dformato')->references('id')->on('dformatos')->onUpdate('cascade');

      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localdiscos');
    }
};
