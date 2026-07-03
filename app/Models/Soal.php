<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Soal extends Model 
{
    use HasFactory;
   
    protected $table = 'soal';

    protected $primaryKey = 'id_soal';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kuis',
        'teks_soal',
        'gambar_soal',
        'nilai',
        'penjelasan',
    ];

    protected $casts = [
        'id_kuis' => 'integer',
        'nilai' => 'integer',
    ];
}
