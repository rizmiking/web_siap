<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelatihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pelatihan',
        'tema',
        'jenis_pelatihan',
        'tanggal_mulai',
        'tanggal_selesai',
        'tempat',
        'penyelenggara',
        'target_peserta',
        'deskripsi',
        'status',
    ];

    /**
     * Relasi balik ke User (Admin pembuat)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
