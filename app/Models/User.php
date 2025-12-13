<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- TAMBAHKAN BARIS INI
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'jurusan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke model Pembayaran.
     * Seorang User (Mahasiswa) dapat memiliki banyak Pembayaran.
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    /**
     * Relasi many-to-many dengan model Tugas.
     * Seorang User (Mahasiswa) dapat mengerjakan banyak Tugas.
     * 
     * INI ADALAH METHOD YANG HILANG DAN MENYEBABKAN ERROR
     */
    public function tugas(): BelongsToMany
    {
        return $this->belongsToMany(Tugas::class, 'mahasiswa_tugas')
                    ->withPivot('waktu_selesai', 'file_path', 'submission_link')
                    ->withTimestamps();
    }
}