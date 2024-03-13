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
        Schema::create('dns', function (Blueprint $table) {
            $table->id();
            $table->string('dnsname')->unique();
            $table->string('dnsip')->unique();
            $table->integer('cve_servidor')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('cve_servidor')->references('id')->on('servidores')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dns');
    }
};
