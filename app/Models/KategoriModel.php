<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'm_kategori'; // Ganti dengan nama tabel yang sesuai, jika berbeda

    // Mendefinisikan primary key dari tabel kategori
    protected $primaryKey = 'kategori_id'; 

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kategori_kode', 
        'kategori_nama'
    ];

    // Hubungan dengan model lain (jika ada)
    public function barangs()
    {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }

    // Tambahkan metode atau logika lain yang diperlukan untuk model ini
}