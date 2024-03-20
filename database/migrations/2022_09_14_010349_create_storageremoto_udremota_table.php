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
        Schema::create('storageremoto_udremota', function (Blueprint $table) {
            $table->id();
            $table->integer('storageremoto_id');
            $table->integer('udremota_id');
            $table->timestamps();
            $table->foreign('storageremoto_id')->references('id')->on('storageremotos')->onDelete('cascade');
            $table->foreign('udremota_id')->references('id')->on('udremotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storageremoto_udremota');
    }
};
