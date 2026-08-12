<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Administrasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelatihan_id',
        'nama',
        'jenis',
        'wajib',
        'status',
        'keterangan',
        'file',
    ];

    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class);
    }
    // Tambahkan di dalam class Pelatihan


}
