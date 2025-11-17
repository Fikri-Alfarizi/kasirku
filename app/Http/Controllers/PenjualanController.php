<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Promo;

class PenjualanController extends Controller
{
    // Tampilkan form kasir
    public function index()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        $promos = \App\Models\Promo::where('aktif',1)->get(['kode','tipe','nilai','aktif']);
        return view('penjualan.index', compact('pelanggan', 'produk', 'promos'));
    }

    // Proses transaksi

    public function store(Request $request)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'keranjang' => 'required|string',
            'bayar' => 'required|numeric|min:0',
        ]);
        $keranjang = json_decode($request->keranjang, true);
        if (!$keranjang || count($keranjang) == 0) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }
        $kodePromo = $request->kode_promo;
        $promo = null;
        $diskon = 0;
        $total_harga = 0;
        $total_setelah_diskon = 0;
        DB::beginTransaction();
        try {
            foreach ($keranjang as $item) {
                $produk = Produk::findOrFail($item['id']);
                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak cukup.");
                }
                $total_harga += $produk->harga * $item['qty'];
            }
            // Cek promo
            if ($kodePromo) {
                $promo = Promo::where('kode', $kodePromo)
                    ->where('aktif', 1)
                    ->where(function($q){
                        $q->whereNull('mulai')->orWhere('mulai', '<=', date('Y-m-d'));
                    })
                    ->where(function($q){
                        $q->whereNull('berakhir')->orWhere('berakhir', '>=', date('Y-m-d'));
                    })
                    ->first();
                if ($promo) {
                    if ($promo->tipe == 'persen') {
                        $diskon = floor($total_harga * $promo->nilai / 100);
                    } else {
                        $diskon = min($promo->nilai, $total_harga);
                    }
                }
            }
            $total_setelah_diskon = $total_harga - $diskon;

            if ($request->bayar < $total_setelah_diskon) {
                throw new \Exception('Nominal bayar kurang dari total belanja!');
            }

            $penjualan = Penjualan::create([
                'id_pelanggan' => $request->id_pelanggan,
                'total_harga' => $total_harga,
                'total_diskon' => $diskon,
                'grand_total' => $total_setelah_diskon,
            ]);

            foreach ($keranjang as $item) {
                $produk = Produk::findOrFail($item['id']);
                DetailPenjualan::create([
                    'id_penjualan' => $penjualan->id,
                    'id_produk' => $produk->id,
                    'jumlah' => $item['qty'],
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $produk->harga * $item['qty'],
                ]);
                $produk->decrement('stok', $item['qty']);
            }

            // Simpan info bayar, kembalian, promo ke session untuk struk
            session([
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total_setelah_diskon,
                'kode_promo' => $promo ? $promo->kode : null,
                'diskon' => $diskon,
                'total_setelah_diskon' => $total_setelah_diskon
            ]);

            DB::commit();
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'url' => route('penjualan.struk', $penjualan->id)]);
            }
            return redirect()->route('penjualan.struk', $penjualan->id);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->expectsJson()) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Tampilkan struk
    public function struk($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'detail.produk'])->findOrFail($id);
        return view('penjualan.struk', compact('penjualan'));
    }
}
