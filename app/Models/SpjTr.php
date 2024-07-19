<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpjTr extends Model
{
    use HasFactory;

    protected $table ="spj_trs";

    protected $fillable = [
        'program', 'kro', 'kegiatan','judul',
        'rencana_output', 'komponen', 'akun', 'bulan', 'tanggal_kegiatan',
        'jenis_spj', 'bendahara', 'ppk', 'status' ,'user_id', 'tanggal_transfer', 'keterangan', 'total_transpor_per_hari', 'total_jumlah_kegiatan', 'total_jumlah_yang_dibayarkan'
    ];

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tabel()
    {
        return $this->hasMany(TabelSpjTr::class, 'spj_id', 'id');
    }


    public function hitungTransporPerHari()
    {
        return $this->tabel()->get()->fresh()->sum("transpor_per_hari");
    }

    public function hitungJumlahKegiatan()
    {
        return $this->tabel()->get()->fresh()->sum("jumlah_kegiatan");
    }

    public function hitungJumlahYangDibayarkan()
    {
        return $this->tabel()->get()->fresh()->sum("jumlah_yang_dibayarkan");
    }
}
