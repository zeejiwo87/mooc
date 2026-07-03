<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $primaryKey = 'id_pendaftaran';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id_pengguna',
        'id_kelas',
        'terdaftar_pada',
        'persentase_progres',
        'status',
        'selesai_pada',
        'terakhir_akses',
    ];

    protected $casts = [
        'id_pengguna' => 'integer',
        'id_kelas' => 'integer',
        'persentase_progres' => 'decimal:2',
        'terdaftar_pada' => 'datetime:Y-m-d H:i:s',
        'selesai_pada' => 'datetime:Y-m-d H:i:s',
        'terakhir_akses' => 'datetime:Y-m-d H:i:s',
        'status' => 'string',
    ];
}