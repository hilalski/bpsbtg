<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pengadaan', 'tanggal_pengadaan', 'status', 'penyelenggara'];


    public function dokumenPengadaans()
    {
        return $this->hasMany(DokumenPengadaan::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'penyelenggara');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusChanges()
    {
        return $this->hasMany(StatusPengadaan::class);
    }

    public function penolakan()
    {
        return $this->hasMany(Penolakan::class);
    }
}
