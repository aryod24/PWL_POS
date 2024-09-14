<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'Supplier 1',
                'supplier_alamat' => 'Jl. Anggrek No.10',
                'supplier_notlp' => '081233445567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'Supplier 2',
                'supplier_alamat' => 'Jl. Melati No.22',
                'supplier_notlp' => '081245678901',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Supplier 3',
                'supplier_alamat' => 'Jl. Mawar No.33',
                'supplier_notlp' => '081256789012',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
