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
        Schema::create('latlong', function (Blueprint $table) {
            $table->id('id_latlong');
            $table->timestamps();
            $table->string('kelurahan');
            $table->string('type');
            $table->string('kodeRTRW');
            $table->text('coordinates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latlong');
    }
};
