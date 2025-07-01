<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahDanTanggalToPencairanSaldoTable extends Migration
{
    public function up()
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            // Hapus penambahan kolom jumlah_pencairan karena sudah ada
            // $table->decimal('jumlah_pencairan', 15, 2)->after('no_rek');

            // Tambah kolom tanggal_pengajuan jika belum ada
            if (!Schema::hasColumn('pencairan_saldo', 'tanggal_pengajuan')) {
                $table->timestamp('tanggal_pengajuan')->nullable()->after('jumlah_pencairan');
            }

            // Tambah kolom status jika belum ada
            if (!Schema::hasColumn('pencairan_saldo', 'status')) {
                $table->string('status')->default('pending')->after('tanggal_pengajuan');
            }
        });
    }

    public function down()
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            if (Schema::hasColumn('pencairan_saldo', 'tanggal_pengajuan')) {
                $table->dropColumn('tanggal_pengajuan');
            }
            if (Schema::hasColumn('pencairan_saldo', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
