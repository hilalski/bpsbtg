<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'nip',
        'password',
        // 'unit',
        // 'gaji',
        'phone_number',
        'role',
        // 'is_kepala_unit',
        // 'is_tim_keuangan',
        // 'is_unit',
        'is_operator',
        // 'is_pbj',
        // 'is_ppk',
        // 'is_admin',
        // 'picture',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_role')->orderBy('role_id');
    }

    public function izins()
    {
        return $this->hasMany(Izin::class);
    }
    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function spj()
    {
        return $this->hasMany(Spj::class);
    }

    public function spj_pd()
    {
        return $this->hasMany(SpjPd::class);
    }

    public function spj_tr()
    {
        return $this->hasMany(SpjTr::class);
    }

    public function pengadaans()
    {
        return $this->hasMany(Pengadaan::class);
    }

    public function pengajuanSurTug()
    {
        return $this->hasMany(PengajuanSuratTugas::class);
    }
}
