<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'm_barang'; // Ganti dengan nama tabel yang sesuai

    // Mendefinisikan primary key dari tabel barang
    protected $primaryKey = 'barang_id';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kategori_id', 
        'barang_kode', 
        'barang_nama', 
        'harga_beli', 
        'harga_jual'
    ];

    // Hubungan dengan model Kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    // Tambahkan metode atau logika lain yang diperlukan untuk model ini
}