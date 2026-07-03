<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Materi extends Model 
{
    use HasFactory;
  

    protected $table = 'materi';

    protected $primaryKey = 'id_materi';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_bagian_kelas',
        'judul',
        'tipe',
        'content',
        'url_video',
        'url_lampiran',
        'urutan',
        'durasi_detik',
        'preview',
    ];

    protected $casts = [
        'id_bagian_kelas' => 'integer',
        'urutan' => 'integer',
        'durasi_detik' => 'integer',
        'preview' => 'boolean',
    ];
}
