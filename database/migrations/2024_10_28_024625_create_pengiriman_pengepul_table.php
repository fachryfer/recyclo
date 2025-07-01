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
        Schema::create('pengiriman_pengepul', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengiriman');
            $table->date('tanggal_pengiriman')->nullable();
            $table->foreignId('pengepul_id')->constrained('pengepul')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_pengepul');
    }
};
