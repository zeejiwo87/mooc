<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ProgresKuis extends Model 
{
    use HasFactory;


    protected $table = 'progres_kuis';

    protected $primaryKey = 'id_progres_kuis';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id_progres_kelas',
        'id_pendaftaran',
        'id_kuis',
        'nilai',
        'total_soal',
        'jawaban_benar',
        'lulus',
        'diserahkan_pada',
    ];

    protected $casts = [
        'id_progres_kelas' => 'integer',
        'id_pendaftaran' => 'integer',
        'id_kuis' => 'integer',
        'nilai' => 'decimal:2',
        'total_soal' => 'integer',
        'jawaban_benar' => 'integer',
        'lulus' => 'boolean',
        'diserahkan_pada' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
