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
        Schema::create('rtrw', function (Blueprint $table) {
            $table->id();
            $table->integer('kawasan');
            $table->string('rtrw');
            $table->float('luasFlag');
            $table->float('luasVerifikasi');
            $table->integer('jumlahBangunan');
            $table->integer('jumlahPenduduk');
            $table->integer('jumlahKK');
            $table->integer('panjangJalanIdeal');
            $table->integer('panjangDrainaseIdeal');

            $table->foreign('kawasan')->references('id')->on('kawasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rtrw');
    }
};
