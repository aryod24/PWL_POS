<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'pembeli' => 'Alice Cooper',
                'penjualan_kode' => 'PEN001',
                'penjualan_tanggal' => '2024-03-01 10:00:00',
                'user_id' => 1,
            ],
            [
                'penjualan_id' => 2,
                'pembeli' => 'Bob Dylan',
                'penjualan_kode' => 'PEN002',
                'penjualan_tanggal' => '2024-03-01 10:30:00',
                'user_id' => 1,
            ],
            [
                'penjualan_id' => 3,
                'pembeli' => 'Charlie Parker',
                'penjualan_kode' => 'PEN003',
                'penjualan_tanggal' => '2024-03-01 11:00:00',
                'user_id' => 1,
            ],
            [
                'penjualan_id' => 4,
                'pembeli' => 'Diana Ross',
                'penjualan_kode' => 'PEN004',
                'penjualan_tanggal' => '2024-03-01 11:30:00',
                'user_id' => 1,
            ],
            [
                'penjualan_id' => 5,
                'pembeli' => 'Eddie Van Halen',
                'penjualan_kode' => 'PEN005',
                'penjualan_tanggal' => '2024-03-02 09:00:00',
                'user_id' => 2,
            ],
            [
                'penjualan_id' => 6,
                'pembeli' => 'Fiona Apple',
                'penjualan_kode' => 'PEN006',
                'penjualan_tanggal' => '2024-03-02 09:30:00',
                'user_id' => 2,
            ],
            [
                'penjualan_id' => 7,
                'pembeli' => 'George Harrison',
                'penjualan_kode' => 'PEN007',
                'penjualan_tanggal' => '2024-03-02 10:00:00',
                'user_id' => 2,
            ],
            [
                'penjualan_id' => 8,
                'pembeli' => 'Helen Mirren',
                'penjualan_kode' => 'PEN008',
                'penjualan_tanggal' => '2024-03-02 10:30:00',
                'user_id' => 3,
            ],
            [
                'penjualan_id' => 9,
                'pembeli' => 'Iggy Pop',
                'penjualan_kode' => 'PEN009',
                'penjualan_tanggal' => '2024-03-03 08:00:00',
                'user_id' => 3,
            ],
            [
                'penjualan_id' => 10,
                'pembeli' => 'Jack White',
                'penjualan_kode' => 'PEN010',
                'penjualan_tanggal' => '2024-03-03 08:30:00',
                'user_id' => 3,
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
