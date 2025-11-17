<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        Promo::insert([
            [
                'kode' => 'PROMO10',
                'nama' => 'Diskon 10%',
                'tipe' => 'persen',
                'nilai' => 10,
                'mulai' => now()->subDays(10),
                'berakhir' => now()->addDays(20),
                'aktif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'HEMAT5000',
                'nama' => 'Potongan 5000',
                'tipe' => 'nominal',
                'nilai' => 5000,
                'mulai' => now()->subDays(5),
                'berakhir' => now()->addDays(10),
                'aktif' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'TIDAKAKTIF',
                'nama' => 'Promo Tidak Aktif',
                'tipe' => 'persen',
                'nilai' => 20,
                'mulai' => now()->subDays(1),
                'berakhir' => now()->addDays(5),
                'aktif' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
