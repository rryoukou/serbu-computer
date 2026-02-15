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
        Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Nama barang
    $table->enum('category', ['Laptop', 'Aksesoris']); // Kategori
    $table->text('specs')->nullable(); // Spesifikasi
    $table->decimal('price', 12, 2); // Harga
    $table->integer('stock')->default(0); // Stok
    $table->text('details')->nullable(); // Detail barang
    $table->text('purchase_guide')->nullable(); // Panduan pembelian
    $table->string('photo')->nullable(); // Foto barang
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
