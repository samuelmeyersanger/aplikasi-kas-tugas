<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tagihan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi ke model Pembayaran.
     * Sebuah Tagihan dapat memiliki banyak Pembayaran dari mahasiswa yang berbeda.
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
}