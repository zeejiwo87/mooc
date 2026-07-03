<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


final class Kuis extends Model 
{
    use HasFactory;
  

    protected $table = 'kuis';

    protected $primaryKey = 'id_kuis';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_materi',
        'judul',
        'deskripsi',
        'instruksi',
        'tipe',
        'durasi_menit',
        'nilai_lulus',
        'tampilkan_jawaban_benar',
        'acak_soal',
        'acak_jawaban',
        'aktif',
    ];

    protected $casts = [
        'id_materi' => 'integer',
        'durasi_menit' => 'integer',
        'nilai_lulus' => 'integer',
        'tampilkan_jawaban_benar' => 'boolean',
        'acak_soal' => 'boolean',
        'acak_jawaban' => 'boolean',
        'aktif' => 'boolean',
    ];
}
