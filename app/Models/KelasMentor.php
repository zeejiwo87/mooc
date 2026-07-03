<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class KelasMentor extends Model
{
    use HasFactory;

    protected $table = 'kelas_mentor';

    protected $primaryKey = 'id_kelas_mentor';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'id_kelas',
        'id_mentor',
        'peran',
    ];

    protected $casts = [
        'id_kelas' => 'integer',
        'id_mentor' => 'integer',
        'peran' => 'string',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class, 'id_mentor', 'id_mentor');
    }
}
