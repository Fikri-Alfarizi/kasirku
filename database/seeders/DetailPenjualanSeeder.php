<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('detail_penjualan')->insert([
            [
                'id_penjualan' => 1,
                'id_produk' => 1,       // Kopi Botol
                'jumlah' => 2,
                'harga_satuan' => 15000,
                'subtotal' => 30000,
            ],
            [
                'id_penjualan' => 1,
                'id_produk' => 2,       // Teh Lemon
                'jumlah' => 1,
                'harga_satuan' => 12000,
                'subtotal' => 12000,
            ],
        ]);
    }
}
