<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresKuisHistori extends Model
{
    use HasFactory;

    protected $table = 'progres_kuis_histori';

    protected $primaryKey = 'id_progres_kuis_histori';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id_progres_kuis',
        'percobaan_ke',
        'nilai',
        'total_soal',
        'jawaban_benar',
        'lulus',
        'diserahkan_pada',
    ];

    protected $casts = [
        'id_progres_kuis' => 'integer',
        'percobaan_ke' => 'integer',
        'nilai' => 'decimal:2',
        'total_soal' => 'integer',
        'jawaban_benar' => 'integer',
        'lulus' => 'boolean',
        'diserahkan_pada' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
