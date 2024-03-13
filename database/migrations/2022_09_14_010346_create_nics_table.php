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
      Schema::create('nics', function (Blueprint $table) {
          $table->id();
          $table->integer('cve_servidor');
          $table->string('nic');
          $table->integer('cve_tnic');
          $table->string('ip')->nullable();
          $table->integer('cve_dns1')->nullable();
          $table->integer('cve_dns2')->nullable();
          $table->integer('cve_dns3')->nullable();
          $table->string('gateway')->nullable();
          $table->string('mac')->unique();
          $table->string('netmask')->nullable();
          $table->text('descripcion')->nullable();
          $table->timestamps();
          $table->foreign('cve_servidor')->references('id')->on('servidores')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('cve_tnic')->references('id')->on('tnics')->onUpdate('cascade');
          $table->foreign('cve_dns1')->references('id')->on('dns')->onUpdate('cascade');
          $table->foreign('cve_dns2')->references('id')->on('dns')->onUpdate('cascade');
          $table->foreign('cve_dns3')->references('id')->on('dns')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nics');
    }
};
