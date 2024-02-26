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
        Schema::create('datacenters', function (Blueprint $table) {
            $table->id();
            $table->string('datacenter');
            $table->integer('cve_tipodc')->references('id')->on('tipodcs')->onDelete('restrict')->onUpdate('cascade');
            // $table->text('desc_datacenter')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('cve_tipodc')->references('id')->on('tipodcs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datacenters');
    }
};
