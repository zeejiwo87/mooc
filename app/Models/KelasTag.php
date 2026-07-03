<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class KelasTag extends Model
{
    use HasFactory;

    protected $table = 'kelas_tag';

    protected $primaryKey = null;

    protected $keyType = 'int';

    public $incrementing = false;

    public $timestamps = true;

    const UPDATED_AT = null;

    protected $fillable = [
        'id_kelas',
        'id_tag',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'id_tag' => 'integer',
    ];

    protected function setKeysForSaveQuery($query)
    {
        return $query
            ->where('id_kelas', $this->getOriginal('id_kelas', $this->id_kelas))
            ->where('id_tag', $this->getOriginal('id_tag', $this->id_tag));
    }
}