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
        Schema::create('kumuh_kawasan', function (Blueprint $table) {
            $table->id();
            $table->integer('kawasan');
            $table->integer('tahun');

            $table->integer('1av');
            $table->float('1ap');
            $table->integer('1an');
            $table->integer('1bv');
            $table->float('1bp');
            $table->integer('1bn');
            $table->integer('1cv');
            $table->float('1cp');
            $table->integer('1cn');
            $table->integer('1r');

            $table->integer('2av');
            $table->float('2ap');
            $table->integer('2an');
            $table->integer('2bv');
            $table->float('2bp');
            $table->integer('2bn');
            $table->integer('2r');

            $table->integer('3av');
            $table->float('3ap');
            $table->integer('3an');
            $table->integer('3bv');
            $table->float('3bp');
            $table->integer('3bn');
            $table->integer('3r');

            $table->integer('4av');
            $table->float('4ap');
            $table->integer('4an');
            $table->integer('4bv');
            $table->float('4bp');
            $table->integer('4bn');
            $table->integer('4cv');
            $table->float('4cp');
            $table->integer('4cn');
            $table->integer('4r');

            $table->integer('5av');
            $table->float('5ap');
            $table->integer('5an');
            $table->integer('5bv');
            $table->float('5bp');
            $table->integer('5bn');
            $table->integer('5r');

            $table->integer('6av');
            $table->float('6ap');
            $table->integer('6an');
            $table->integer('6bv');
            $table->float('6bp');
            $table->integer('6bn');
            $table->integer('6r');

            $table->integer('7av');
            $table->float('7ap');
            $table->integer('7an');
            $table->integer('7bv');
            $table->float('7bp');
            $table->integer('7bn');
            $table->integer('7r');

            $table->integer('totalNilai');
            $table->string('tingkatKekumuhan');
            $table->float('ratarataKekumuhan');
            $table->float('kontribusiPenanganan');

            $table->foreign('kawasan')->references('id')->on('kawasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kumuh_kawasan');
    }
};
