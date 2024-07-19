<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPengadaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumen_id',
        'dokumen_memo',
        'dokumen_kak',
        'dokumen_identifikasi_kebutuhan',
        'dokumen_perencanaan_pengadaan',
        'dokumen_hps',
        'dokumen_nota_dinas',
        'dokumen_undangan',
        'dokumen_ssuk_sskk',
        'dokumen_ikp',
        'dokumen_ldp_dan_spesifikasi',
        'dokumen_penawaran_pakta_formulir',
        'dokumen_surat_permintaan',
        'dokumen_pengadaan_langsung',
        'dokumen_serah_terima',
        'dokumen_bast',
        'harga_anggaran'
    ];

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id');
    }
}
