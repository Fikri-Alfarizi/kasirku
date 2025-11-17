<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penjualan')->insert([
            [
                'tanggal_penjualan' => now(),
                'id_pelanggan' => 1,
                'total_harga' => 42000,   // sebelum diskon
                'total_diskon' => 2000,    // potongan
                'grand_total' => 40000,    // setelah diskon
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
