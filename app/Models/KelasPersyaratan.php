<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class KelasPersyaratan extends Model 
{
    use HasFactory;
    

    protected $table = 'kelas_persyaratan';

    protected $primaryKey = 'id_persyaratan';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'persyaratan',
        'urutan',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'urutan' => 'integer',
    ];
}
