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
        Schema::create('compartidodiscos', function (Blueprint $table) {
            $table->id();
            $table->string('compartidodisco');
            $table->integer('cve_servidor');
            $table->integer('cve_tdisco');
            $table->integer('cve_servidor_host');
            $table->integer('cve_drl');
            $table->integer('cve_tecremotadisco');
            $table->string('montaje');
            $table->string('comandos');
            $table->string('descripcion');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compartidodiscos');
    }
};
