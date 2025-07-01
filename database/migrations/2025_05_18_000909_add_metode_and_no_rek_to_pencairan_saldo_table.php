<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            $table->string('metode_pencairan')->after('nasabah_id');
            $table->string('no_rek')->nullable()->after('metode_pencairan');
        });
    }

    public function down(): void
    {
        Schema::table('pencairan_saldo', function (Blueprint $table) {
            $table->dropColumn(['metode_pencairan', 'no_rek']);
        });
    }
};
