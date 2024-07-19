<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengadaan extends Model
{
    use HasFactory;
    protected $fillable = ['pengadaan_id', 'status', 'changed_at'];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
}
