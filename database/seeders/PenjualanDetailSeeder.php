<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        $jumlah_transaksi = 10;

        for ($i = 1; $i <= $jumlah_transaksi; $i++) {
            $barang_ids = range(1, 3); 
            foreach ($barang_ids as $barang_id) {
                $data[] = [
                    'detail_id' => count($data) + 1,
                    'harga' => rand(10000, 500000), 
                    'jumlah' => rand(1, 10), 
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id,
                ];
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
    }