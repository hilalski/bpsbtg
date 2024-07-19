<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelSpjPd extends Model
{
    use HasFactory;

    protected $table = "tabel_spj_pds";
    protected $fillable = [
        'user_id','spj_id','nama_pelaksanaan_perjalanan_dinas', 'gol','asal_penugasan', 
        'daerah_tujuan_perjalanan_dinas', 'lama_perjalanan', 'uang_harian', 'transport', 'bandara', 
        'biaya_hotel', 'jumlah_biaya', 'uang_muka', 'kekurangan', 'nama_bank', 'nomor_rekening'
    ];

    // Define the 'user' relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the 'spj' relationship
    public function spj()
    {
        return $this->belongsTo(SpjPd::class, 'spj_id', 'user_id');
    }
}
