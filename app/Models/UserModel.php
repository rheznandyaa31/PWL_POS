<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
        'avatar',
    ];

    // Menyembunyikan kolom password agar tidak ditampilkan di JSON output
    protected $hidden = [
        'password',
    ];
}
