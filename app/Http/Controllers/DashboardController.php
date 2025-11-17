<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $totalPenjualanHariIni = Penjualan::whereDate('created_at', $today)->sum('grand_total');
        $totalTransaksiHariIni = Penjualan::whereDate('created_at', $today)->count();
        $totalPelanggan = Pelanggan::count();
        $totalProduk = Produk::count();
        $totalPenjualanBulanIni = Penjualan::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('grand_total');

        $produk = Produk::orderBy('created_at', 'desc')->limit(10)->get();
        return view('dashboard', [
            'totalPenjualanHariIni' => $totalPenjualanHariIni,
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
            'totalPelanggan' => $totalPelanggan,
            'totalProduk' => $totalProduk,
            'totalPenjualanBulanIni' => $totalPenjualanBulanIni,
            'produk' => $produk,
        ]);
    }
}
