<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nama Penerima
            $table->string('phone');         // Nomor HP
            $table->text('address');         // Alamat Pengiriman
            $table->string('payment_method');// Metode Pembayaran
            $table->string('item_ordered');  // Menu yang Dipilih
            $table->decimal('price', 10, 2); // Total Harga
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};