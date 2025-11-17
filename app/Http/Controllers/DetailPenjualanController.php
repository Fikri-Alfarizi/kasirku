<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $details = DetailPenjualan::with('penjualan', 'produk')->get();
        return view('detail.index', compact('details'));
    }
}
