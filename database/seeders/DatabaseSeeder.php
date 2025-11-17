<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
public function run(): void
{
    $this->call([
        UserSeeder::class,
        PelangganSeeder::class,
        ProdukSeeder::class,
        PromoSeeder::class,
        PenjualanSeeder::class,
    ]);
}

}
