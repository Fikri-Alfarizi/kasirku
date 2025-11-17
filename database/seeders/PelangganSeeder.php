<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::create([
            'nama' => 'Budi Santoso',
            'no_hp' => '08123456789',
            'alamat' => 'Jl. Mawar No. 10',
        ]);

        Pelanggan::create([
            'nama' => 'Siti Aminah',
            'no_hp' => '08987654321',
            'alamat' => 'Jl. Melati No. 22',
        ]);
    }
}
