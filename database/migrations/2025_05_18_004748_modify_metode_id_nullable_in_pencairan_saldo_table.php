<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMetodeIdNullableInPencairanSaldoTable extends Migration
{
    public function up(): void
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            // Jika ingin membuat kolom metode_id nullable:
            $table->unsignedBigInteger('metode_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            // Mengembalikan metode_id menjadi NOT NULL
            $table->unsignedBigInteger('metode_id')->nullable(false)->change();
        });
    }
}
