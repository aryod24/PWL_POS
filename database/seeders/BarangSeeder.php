<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Roti Tawar',
                'harga_beli' => 8000,
                'harga_jual' => 15000,
                'kategori_id' => 1,
            ],
            [
                'barang_id' => 2,
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Cokelat Batang',
                'harga_beli' => 12000,
                'harga_jual' => 20000,
                'kategori_id' => 1,
            ],

            [
                'barang_id' => 3,
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Air Mineral 600ml',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
                'kategori_id' => 2,
            ],
            [
                'barang_id' => 4,
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Soda Can 330ml',
                'harga_beli' => 7000,
                'harga_jual' => 12000,
                'kategori_id' => 2,
            ],

            [
                'barang_id' => 5,
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Novel Fiksi',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
                'kategori_id' => 3,
            ],
            [
                'barang_id' => 6,
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Buku Pelajaran',
                'harga_beli' => 40000,
                'harga_jual' => 60000,
                'kategori_id' => 3,
            ],

            [
                'barang_id' => 7,
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Kaos Polos',
                'harga_beli' => 35000,
                'harga_jual' => 50000,
                'kategori_id' => 4,
            ],
            [
                'barang_id' => 8,
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Jaket Hoodie',
                'harga_beli' => 150000,
                'harga_jual' => 200000,
                'kategori_id' => 4,
            ],

            [
                'barang_id' => 9,
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Pensil 2B',
                'harga_beli' => 1000,
                'harga_jual' => 3000,
                'kategori_id' => 5,
            ],
            [
                'barang_id' => 10,
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Penggaris 30cm',
                'harga_beli' => 2000,
                'harga_jual' => 5000,
                'kategori_id' => 5,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
