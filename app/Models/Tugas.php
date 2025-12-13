<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tugas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi many-to-many dengan model User (Mahasiswa).
     * Sebuah Tugas dapat dikerjakan oleh banyak Mahasiswa.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'mahasiswa_tugas')
                    ->withPivot('waktu_selesai', 'file_path', 'submission_link')
                    ->withTimestamps();
    }
}