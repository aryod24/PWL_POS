<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model
{
    // Menentukan nama tabel yang terkait dengan model ini (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'm_level'; // Ganti dengan nama tabel yang sesuai

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'level_id';

    // Menentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = ['level_kode', 'level_nama']; // Ganti dengan kolom yang sesuai

    // Hubungan dengan model lain (jika ada)
    public function users()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }

    // Tambahkan metode atau logika lain yang diperlukan untuk model ini
}