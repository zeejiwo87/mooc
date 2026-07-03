<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class KelasTargetPeserta extends Model 
{
    use HasFactory;


    protected $table = 'kelas_target_peserta';

    protected $primaryKey = 'id_target';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'target',
        'urutan',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'urutan' => 'integer',
    ];
}
