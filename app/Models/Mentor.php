<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

final class Mentor extends Authenticatable 
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $keyType = 'string';

    protected $primaryKey = 'id_mentor';

    protected $table = 'mentor';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'foto_profil',
        'bio',
        'spesialisasi',
        'total_siswa',
        'rating_rata',
    ];

    protected $guarded = [
        'id_mentor',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    private string $guard = 'mentor';
}
