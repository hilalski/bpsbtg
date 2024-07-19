<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelSpj extends Model
{
    use HasFactory;

    protected $table = "tabel_spjs";
    protected $fillable = [
        'nama_dosen', 'golongan', 'rate_honor', 'sks_wajib', 'sks_hadir',
        'sks_dibayar', 'jumlah_bruto', 'pajak', 'jumlah_diterima',
        'nomor_rekening', 'nama_rekening', 'user_id', 'spj_id'
    ];

    // Define the 'user' relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the 'spj' relationship
    public function spj()
    {
        return $this->belongsTo(Spj::class, 'spj_id', 'user_id');
    }
}
