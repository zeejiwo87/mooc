<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

final class Pengguna extends Authenticatable 
{
    use HasFactory;
   
    use SoftDeletes;

    public $timestamps = true;

    protected $keyType = 'string';

    protected $primaryKey = 'id_pengguna';

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'foto_profil',
        'bio',
        'telepon',
        'terverifikasi',
        'last_login',
        'total_kelas_selesai',
        'total_poin',
        'remember_token',
    ];

    protected $guarded = [
        'id_pengguna',
        'email',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    private string $guard = 'pengguna';
}
