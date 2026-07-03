<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

final class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';

    protected $primaryKey = 'id_admin';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}