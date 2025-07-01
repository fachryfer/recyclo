<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            $table->dropColumn('nama_metode_pencairan');
        });
    }

    public function down(): void
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            $table->string('nama_metode_pencairan')->nullable();
        });
    }
};
