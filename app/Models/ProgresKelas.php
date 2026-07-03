<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ProgresKelas extends Model 
{
    use HasFactory;
   

    protected $table = 'progres_kelas';

    protected $primaryKey = 'id_progres_kelas';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id_pendaftaran',
        'id_bagian_kelas',
        'id_materi',
        'urutan_bagian_kelas',
        'urutan_materi',
        'selesai',
        'waktu_belajar_detik',
        'posisi_video_terakhir',
        'selesai_pada',
    ];

    protected $casts = [
        'id_pendaftaran' => 'integer',
        'id_materi' => 'integer',
        'id_bagian_kelas' => 'integer',
        'urutan_bagian_kelas' => 'integer',
        'urutan_materi' => 'integer',
        'selesai' => 'boolean',
        'waktu_belajar_detik' => 'integer',
        'posisi_video_terakhir' => 'integer',
        'selesai_pada' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
