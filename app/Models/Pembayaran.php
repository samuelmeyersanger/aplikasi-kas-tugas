<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke model User (Mahasiswa).
     * Sebuah Pembayaran dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Tagihan.
     * Sebuah Pembayaran terkait dengan satu Tagihan.
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }
}