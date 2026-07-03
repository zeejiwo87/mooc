<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ProgresJawaban extends Model
{
    use HasFactory;

    protected $table = 'progres_jawaban';

    protected $primaryKey = 'id_progres_jawaban';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_progres_kuis',
        'id_soal',
        'id_soal_jawaban',
        'benar',
        'poin_diperoleh',
    ];

    protected $casts = [
        'id_progres_kuis' => 'integer',
        'id_soal' => 'integer',
        'id_soal_jawaban' => 'integer',
        'benar' => 'boolean',
        'poin_diperoleh' => 'integer',
    ];
}