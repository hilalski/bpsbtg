<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpjPd extends Model
{
    use HasFactory;

    protected $table ="spj_pds";
    protected $fillable = [
        'user_id','judul','program', 'kegiatan', 'kro','komponen', 'akun', 'jenis_spj','bendahara','ppk','tanggal_tugas',
        'total_uang_harian', 'total_transport', 'total_bandara', 'total_biaya_hotel',
        'total_jumlah_biaya', 'total_uang_muka', 'total_kekurangan', 'status', 'keterangan','tanggal_transfer'
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
        return $this->hasMany(TabelSpjPd::class, 'spj_id', 'id');
    }

    public function totalUangHarian()
    {
        return $this->tabel()->get()->fresh()->sum("uang_harian");
    }

    public function totalTransport()
    {
        return $this->tabel()->get()->fresh()->sum("transport");
    }

    public function totalBandara()
    {
        return $this->tabel()->get()->fresh()->sum("bandara");
    }

    public function totalBiayaHotel()
    {
        return $this->tabel()->get()->fresh()->sum("biaya_hotel");
    }

    public function totalJumlah_Biaya()
    {
        return $this->tabel()->get()->fresh()->sum("jumlah_biaya");
    }

    public function totalUangMuka()
    {
        return $this->tabel()->get()->fresh()->sum("uang_muka");
    }

    public function totalKekurangan()
    {
        return $this->tabel()->get()->fresh()->sum("kekurangan");
    }
}
