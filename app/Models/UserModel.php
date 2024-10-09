<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id';  // Mendefinisikan primary key dari tabel yang digunakan

    // Menyediakan atribut yang dapat diisi secara massal
    protected $fillable = ['level_id', 'username', 'nama', 'password', 'created_at', 'updated_at'];

    // Atribut yang disembunyikan saat query
    protected $hidden = ['password'];

    // Casting password agar otomatis di-hash
    protected $casts = ['password' => 'hashed'];

    // Relasi ke model LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
