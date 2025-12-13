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
Schema::create('tagihans', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->text('deskripsi')->nullable();
    $table->decimal('jumlah', 15, 2);
    $table->date('tanggal_tagihan');
    $table->date('batas_pembayaran');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
