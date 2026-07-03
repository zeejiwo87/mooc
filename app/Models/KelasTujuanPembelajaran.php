<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class KelasTujuanPembelajaran extends Model 
{
    use HasFactory;
  

    protected $table = 'kelas_tujuan_pembelajaran';

    protected $primaryKey = 'id_tujuan';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'tujuan',
        'urutan',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'urutan' => 'integer',
    ];
}
