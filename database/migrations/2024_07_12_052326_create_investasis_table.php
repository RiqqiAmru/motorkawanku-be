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
            $table->id('id_investasi');
            $table->integer('tahun');
            $table->foreignId('id_kawasan')->constrained('kawasan', 'id_kawasan');
            $table->string('id_rtrw');
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
