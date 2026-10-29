<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembayaran_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->date('tanggal_periode');
            $table->boolean('apakah_bayar')->default(false);
            $table->boolean('kena_denda')->default(false);
            $table->timestamps();
            
            $table->unique(['anggota_id', 'tanggal_periode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_kas');
    }
};
