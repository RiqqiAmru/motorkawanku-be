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
        Schema::create('investasi', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->foreignId('idKawasan')->constrained('kawasan');
            $table->string('idRTRW');
            $table->string('idkriteria');
            $table->integer('volume');
            $table->string('kegiatan');
            $table->string('sumberAnggaran')->nullable();
            $table->integer('anggaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investasi');
    }
};