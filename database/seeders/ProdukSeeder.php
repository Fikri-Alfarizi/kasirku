<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'Le Mineral',
            'harga' => 5000,
            'stok' => 50,
            'deskripsi' => 'Air mineral 600ml.',
            'gambar' => 'https://d2qjkwm11akmwu.cloudfront.net/products/338234_18-9-2019_15-50-20-1665805161.webp',
        ]);
        Produk::create([
            'nama_produk' => 'Mie Sedaap Ayam Istimewa',
            'harga' => 3500,
            'stok' => 40,
            'deskripsi' => 'Mie instan rasa ayam istimewa.',
            'gambar' => 'https://wingscorp.com/wp-content/uploads/2020/10/Foto-Pack-Mie-Sedaap-Ayam-Istimewa.png',
        ]);
        Produk::create([
            'nama_produk' => 'Beng Beng Share It',
            'harga' => 12000,
            'stok' => 25,
            'deskripsi' => 'Coklat Beng Beng Share It 95gr.',
            'gambar' => 'https://image.astronauts.cloud/product-images/2024/4/BengBengShareIt95gr1_69daad78-2d17-425a-b15c-c7eeedc82f73_900x900.png',
        ]);
        Produk::create([
            'nama_produk' => 'Oreo',
            'harga' => 8000,
            'stok' => 35,
            'deskripsi' => 'Biskuit Oreo 133gr.',
            'gambar' => 'https://img.lazcdn.com/g/p/000172b8ed3061a0cbe269f39cc947d3.png_720x720q80.png',
        ]);
        Produk::create([
            'nama_produk' => 'Arnon Steam Cheese Cake Banana 60G',
            'harga' => 7000,
            'stok' => 20,
            'deskripsi' => 'Arnon Steam Cheese Cake Banana 60G',
            'gambar' => 'https://www.klikindomaret.com/assets-klikidmcore/_next/image?url=https%3A%2F%2Fcdn-klik.klikindomaret.com%2Fklik-catalog%2Fproduct%2F20137768_thumb.jpg&w=1920&q=75',
        ]);
        Produk::create([
            'nama_produk' => "Wall's Ice Cream Magnum Mini Box 6x45mL",
            'harga' => 56000,
            'stok' => 10,
            'deskripsi' => "Wall's Ice Cream Magnum Mini Box 6x45mL",
            'gambar' => 'https://www.klikindomaret.com/assets-klikidmcore/_next/image?url=https%3A%2F%2Fcdn-klik.klikindomaret.com%2Fklik-catalog%2Fproduct%2F20138847_thumb.jpg&w=1920&q=75',
        ]);
        Produk::create([
            'nama_produk' => 'Haagen-Dazs Ice Cream Mini Summerberries 75mL',
            'harga' => 30000,
            'stok' => 10,
            'deskripsi' => 'Haagen-Dazs Ice Cream Mini Summerberries 75mL',
            'gambar' => 'https://www.klikindomaret.com/assets-klikidmcore/_next/image?url=https%3A%2F%2Fcdn-klik.klikindomaret.com%2Fklik-catalog%2Fproduct%2F20138573_thumb.jpg&w=1920&q=75',
        ]);
        Produk::create([
            'nama_produk' => 'Haagen-Dazs Ice Cream Mini Cookies 75Ml',
            'harga' => 30000,
            'stok' => 10,
            'deskripsi' => 'Haagen-Dazs Ice Cream Mini Cookies 75Ml',
            'gambar' => 'https://www.klikindomaret.com/assets-klikidmcore/_next/image?url=https%3A%2F%2Fcdn-klik.klikindomaret.com%2Fklik-catalog%2Fproduct%2F20138576_thumb.jpg&w=1920&q=75',
        ]);
        Produk::create([
            'nama_produk' => 'Haagen-Dazs Ice Cream Mini Mango 75mL',
            'harga' => 30000,
            'stok' => 10,
            'deskripsi' => 'Haagen-Dazs Ice Cream Mini Mango 75mL',
            'gambar' => 'https://emdadx.com/wp-content/uploads/2023/12/555020-1.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Haagen-Dazs Ice Cream Mini Chocolate 75Ml',
            'harga' => 30000,
            'stok' => 10,
            'deskripsi' => 'Haagen-Dazs Ice Cream Mini Chocolate 75Ml',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Haagen-Dazs Ice Cream Mini Vanilla 75mL',
            'harga' => 30000,
            'stok' => 10,
            'deskripsi' => 'Haagen-Dazs Ice Cream Mini Vanilla 75mL',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Glico Wings Ice Cream Frost Bite Kopi Jelly Gula Aren 60mL',
            'harga' => 4500,
            'stok' => 10,
            'deskripsi' => 'Glico Wings Ice Cream Frost Bite Kopi Jelly Gula Aren 60mL',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Walls Ice Cream Feast Xtra Max Chocolate 73mL',
            'harga' => 9000,
            'stok' => 10,
            'deskripsi' => 'Walls Ice Cream Feast Xtra Max Chocolate 73mL',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Campina Ice Cream Hula-Hula Maxx Kacang Hijau 65mL',
            'harga' => 6500,
            'stok' => 10,
            'deskripsi' => 'Campina Ice Cream Hula-Hula Maxx Kacang Hijau 65mL',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Oreo Biscuit Sandwich Marshmallow Baby Monster 220.8g',
            'harga' => 21500,
            'stok' => 10,
            'deskripsi' => 'Oreo Biscuit Sandwich Marshmallow Baby Monster 220.8g',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'PAMMA Klepon Chips 60g',
            'harga' => 23500,
            'stok' => 10,
            'deskripsi' => 'PAMMA Klepon Chips 60g',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Floaty Snack Terserah 60g',
            'harga' => 9900,
            'stok' => 10,
            'deskripsi' => 'Floaty Snack Terserah 60g',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Sari Kue Steamed Cheese Cake Strawberry 70g',
            'harga' => 9500,
            'stok' => 10,
            'deskripsi' => 'Sari Kue Steamed Cheese Cake Strawberry 70g',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Meiji Biscuit Hello Panda Double Choco 42G',
            'harga' => 9500,
            'stok' => 10,
            'deskripsi' => 'Meiji Biscuit Hello Panda Double Choco 42G',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'JLO Gummy Surprise Cute Bear 40g',
            'harga' => 9900,
            'stok' => 10,
            'deskripsi' => 'JLO Gummy Surprise Cute Bear 40g',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Aice Ice Cream Crispy Balls Cookies N Cream 65mL',
            'harga' => 6500,
            'stok' => 10,
            'deskripsi' => 'Aice Ice Cream Crispy Balls Cookies N Cream 65mL',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Chupa Chups Big Babol Tongue Painter Raspberry 20g',
            'harga' => 3400,
            'stok' => 10,
            'deskripsi' => 'Chupa Chups Big Babol Tongue Painter Raspberry 20g',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Walls Ice Cream X Point Coffee Palm Sugar Latte 90mL',
            'harga' => 8500,
            'stok' => 10,
            'deskripsi' => 'Walls Ice Cream X Point Coffee Palm Sugar Latte 90mL',
            'gambar' => 'img/noimg.jpg',
        ]);
        Produk::create([
            'nama_produk' => 'Chiki Snack Twist Roasted Corn 120G',
            'harga' => 10500,
            'stok' => 10,
            'deskripsi' => 'Chiki Snack Twist Roasted Corn 120G',
            'gambar' => 'img/noimg.jpg',
        ]);
    }
}
