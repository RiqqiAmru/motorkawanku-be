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
        Schema::table('investasi', function (Blueprint $table) {
            $table->integer('id_user')->nullable();
            $table->string('ket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investasi', function (Blueprint $table) {
            $table->dropColumn('id_user');
            $table->dropColumn('ket');
        });
    }
};