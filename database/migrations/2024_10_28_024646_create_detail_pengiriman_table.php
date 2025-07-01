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
        Schema::create('detail_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiriman_id')->constrained('pengiriman_pengepul')->onDelete('cascade');
            $table->foreignId('sampah_id')->constrained('sampah')->onDelete('cascade');
            $table->decimal('berat_kg', 15, 2);
            $table->decimal('harga_per_kg', 10, 2);
            $table->decimal('harga_total', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengiriman');
    }
};
