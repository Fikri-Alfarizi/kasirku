<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan'; // <--- tambahkan baris ini

    protected $fillable = ['id_penjualan', 'id_produk', 'jumlah', 'harga_satuan', 'subtotal'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }
}
