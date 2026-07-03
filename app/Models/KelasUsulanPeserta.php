<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class KelasUsulanPeserta extends Model 
{
    use HasFactory;
    

    protected $table = 'kelas_usulan';

    protected $primaryKey = 'id_kelas_usulan';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'id_pengguna',
        'rating',
        'ulasan',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'id_pengguna' => 'integer',
        'rating' => 'integer',
    ];
}
