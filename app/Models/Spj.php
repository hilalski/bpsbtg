<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    use HasFactory;

    protected $table ="spjs";
    protected $fillable = [
        'program', 'kro', 'kegiatan',
        'rencana_output', 'komponen', 'akun', 'periode', 'tanggal_kegiatan',
        'jenis_spj', 'bendahara', 'ppk', 'status' ,'user_id', 'tanggal_transfer', 'keterangan', 'total', 'total_pajak', 'total_bruto'
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
        return $this->hasMany(TabelSpj::class);
    }

    public function hitungTotal()
    {
        return $this->tabel()->get()->fresh()->sum("jumlah_diterima");
    }

    public function hitungBruto()
    {
        return $this->tabel()->get()->fresh()->sum("jumlah_bruto");
    }

    public function hitungPajak()
    {
        return $this->tabel()->get()->fresh()->sum("pajak");
    }
}
