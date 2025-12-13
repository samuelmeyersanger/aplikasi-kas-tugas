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
Schema::create('pembayarans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('tagihan_id')->constrained()->onDelete('cascade');
    $table->decimal('jumlah_dibayar', 15, 2);
    $table->string('metode_pembayaran'); // dana, gopay, transfer
    $table->string('bukti_pembayaran'); // nama file gambar
    $table->enum('status', ['menunggu', 'terverifikasi', 'ditolak'])->default('menunggu');
    $table->text('catatan_verifikasi')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
