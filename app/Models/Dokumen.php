<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengadaan_id',
        // Tambahkan kolom lain sesuai kebutuhan
    ];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class,'pengadaan_id');
    }

    public function dokumenPengadaans()
    {
        return $this->hasMany(DokumenPengadaan::class);
    }
}
