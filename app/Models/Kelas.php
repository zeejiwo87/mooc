<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


final class Kelas extends Model 
{
    use HasFactory;
    
    use SoftDeletes;

    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kategori_sub',
        'id_pemilik',
        'judul',
        'slug',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'banner',
        'sertifikat',
        'video_intro_url',
        'tingkat',
        'bahasa',
        'total_durasi_menit',
        'jumlah_materi',
        'rating',
        'nilai_lulus',
        'total_pendaftaran',
        'total_selesai',
        'total_review',
        'status',
    ];

    protected $casts = [
        'id_kategori_sub' => 'integer',
        'id_pemilik' => 'integer',
        'total_durasi_menit' => 'integer',
        'jumlah_materi' => 'integer',
        'rating' => 'float',
        'nilai_lulus' => 'integer',
        'total_pendaftaran' => 'integer',
        'total_selesai' => 'integer',
        'total_review' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
