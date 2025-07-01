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
        Schema::create('pencairan_saldo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade');
            $table->foreignId('metode_id')->constrained('metode_pencairan')->onDelete('cascade');
            $table->decimal('jumlah_pencairan', 15, 2);
            $table->timestamp('tanggal_pengajuan')->nullable();
            $table->timestamp('tanggal_proses')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencairan_saldo');
    }
};
