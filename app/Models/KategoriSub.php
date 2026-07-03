<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class KategoriSub extends Model
{
    use HasFactory;

    protected $table = 'kategori_sub';

    protected $primaryKey = 'id_kategori_sub';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama',
        'deskripsi',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'id_kategori' => 'integer',
        'urutan' => 'integer',
        'aktif' => 'boolean',
    ];
}