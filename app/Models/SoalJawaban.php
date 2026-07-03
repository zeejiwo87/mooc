<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class SoalJawaban extends Model 
{
    use HasFactory;
   

    protected $table = 'soal_jawaban';

    protected $primaryKey = 'id_soal_jawaban';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_soal',
        'teks_jawaban',
        'benar',
    ];

    protected $casts = [
        'id_soal' => 'integer',
        'benar' => 'boolean',
    ];
}
