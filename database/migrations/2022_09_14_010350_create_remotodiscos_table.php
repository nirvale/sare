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
        Schema::create('remotodiscos', function (Blueprint $table) {
          $table->id();
          $table->integer('cve_storageremoto');
          $table->integer('cve_servidor')->nullable();
          $table->integer('cve_udremota');
          $table->string('remotodisco');
          $table->string('pmontaje')->nullable();
          $table->integer('cve_dformato')->nullable();
          $table->string('capacidad');
          $table->string('usado');
          $table->string('usadop');
          $table->text('comontaje')->nullable();
          $table->text('descripcion')->nullable();
          $table->timestamps();
          $table->foreign('cve_servidor')->references('id')->on('servidores')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('cve_dformato')->references('id')->on('dformatos')->onUpdate('cascade');
          $table->foreign('cve_storageremoto')->references('id')->on('storageremotos')->onUpdate('cascade');

      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remotodiscos');
    }
};
