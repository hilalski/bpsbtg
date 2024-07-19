<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PengajuanSuratTugas extends Model
{
    use HasFactory;


    protected $table = 'pengajuan_surat_tugas';
    protected $dates = ['tanggal_ttd'];
    protected $date_start = ['tanggal_perdin_mulai'];
    protected $date_end = ['tanggal_perdin_selesai'];

    protected $fillable = [
        'user_id',
        'no_surtug',
        'name',
        'nip',
        'golongan',
        'jabatan',
        'nama_kegiatan',
        'lokasi',
        'tanggal_perdin_mulai',
        'tanggal_perdin_selesai',
        'tanggal_ttd',
        'nama_pejabat_ttd',
        'jabatan_pejabat_ttd',
        'file_path',
        'status_surtug',
        'lampiran',
        'moda_transportasi',
        'kode_program',
        'kode_kegiatan',
        'kode_output',
        'kode_komponen',
        'kode_sub_komponen',
        'updated',
        'keterangan',
        'ppk',
        'kode_track',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
