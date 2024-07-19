<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelSpjTr extends Model
{
    use HasFactory;

    protected $table = "tabel_spj_trs";
    protected $fillable = [
        'nama','transpor_per_hari','jumlah_kegiatan','jumlah_yang_dibayarkan','bank','nomor_rekening','user_id', 'spj_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the 'spj' relationship
    public function spj()
    {
        return $this->belongsTo(SpjTr::class, 'spj_id', 'id');
    }
}
