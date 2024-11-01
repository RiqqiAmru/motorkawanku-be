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
        Schema::create('sk24_rtrw', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('kawasan');
            $table->string('rtrw');
            $table->float('luasFlag');
            $table->float('luasVerifikasi');
            $table->integer('jumlahBangunan');
            $table->integer('jumlahPenduduk');
            $table->integer('jumlahKK');
            $table->integer('panjangJalanIdeal');
            $table->integer('panjangDrainaseIdeal');

            $table->foreign('kawasan')->references('id')->on('sk24_kawasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk24_rtrw');
    }
};
