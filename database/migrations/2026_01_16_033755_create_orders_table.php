<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->text('pesan')->nullable();
            $table->enum('metode_pembayaran', ['tunai', 'bca']);
            $table->decimal('total_harga', 12, 2);

            $table->enum('status', ['menunggu_pembayaran_tunai','menunggu_verifikasi','selesai'])->default('menunggu_verifikasi');
            $table->timestamp('batas_waktu')->nullable();
            $table->string('bukti_bayar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
