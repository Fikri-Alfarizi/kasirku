<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // <--- tambahkan baris ini

    protected $fillable = ['id_pelanggan', 'total_harga', 'total_diskon', 'grand_total'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }
}
