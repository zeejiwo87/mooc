<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BagianKelas extends Model 
{
    use HasFactory;
   

    protected $table = 'bagian_kelas';

    protected $primaryKey = 'id_bagian_kelas';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'judul',
        'deskripsi',
        'urutan',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'urutan' => 'integer',
    ];
}
