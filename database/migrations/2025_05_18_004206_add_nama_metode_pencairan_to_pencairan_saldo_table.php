<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaMetodePencairanToPencairanSaldoTable extends Migration
{
    public function up()
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            $table->string('nama_metode_pencairan')->after('nasabah_id');
        });
    }

    public function down()
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            $table->dropColumn('nama_metode_pencairan');
        });
    }
}
