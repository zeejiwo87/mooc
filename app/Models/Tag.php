<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    protected $primaryKey = 'id_tag';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'slug',
        'total_kelas',
    ];

    protected $casts = [
        'id_tag' => 'integer',
        'nama' => 'string',
        'slug' => 'string',
        'total_kelas' => 'integer',
    ];
}