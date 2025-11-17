<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
    ];

    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk');
    }
}
