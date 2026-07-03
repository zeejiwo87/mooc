<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';

    protected $primaryKey = 'id_sertifikat';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_pendaftaran',
        'nomor_sertifikat',
        'kode_verifikasi',
        'qr_code_url',
        'pdf_url',
        'nama_penerima',
        'judul_kelas',
        'tanggal_selesai',
        'sudah_dicetak',
        'dicetak_pada',
    ];

    protected $casts = [
        'id_pendaftaran' => 'integer',
        'tanggal_selesai' => 'date',
        'dicetak_pada' => 'datetime',
        'sudah_dicetak' => 'boolean',
    ];
}