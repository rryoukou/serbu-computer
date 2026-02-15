<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Relasi ke product
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // Info produk langsung di order
            $table->string('nama_produk');                
            $table->text('spesifikasi')->nullable();     
            $table->integer('qty');                       
            $table->decimal('harga', 12, 2);             

            // Metode pembayaran & total
            $table->enum('metode_pembayaran', ['tunai', 'bca']);
            $table->decimal('total_harga', 12, 2);       

            // Status order + dibatalkan
            $table->enum('status', [
                'menunggu_pembayaran_tunai',
                'menunggu_verifikasi',
                'selesai',
                'dibatalkan'
            ])->default('menunggu_verifikasi');

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
