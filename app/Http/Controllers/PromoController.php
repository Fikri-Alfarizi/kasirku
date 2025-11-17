<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;



class PromoController extends Controller
{

    public function destroy($id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $promo = Promo::findOrFail($id);
        $promo->delete();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'kode' => 'required|unique:promo,kode,' . $id,
            'nama' => 'required',
            'tipe' => 'required|in:persen,nominal',
            'nilai' => 'required|integer|min:1',
            'mulai' => 'nullable|date',
            'berakhir' => 'nullable|date|after_or_equal:mulai',
        ]);
        // Validasi nilai promo persen tidak boleh lebih dari 100
        if ($request->tipe === 'persen' && $request->nilai > 100) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nilai' => 'Nilai promo persen tidak boleh lebih dari 100.']);
        }
        $promo = Promo::findOrFail($id);
        $promo->kode = $request->kode;
        $promo->nama = $request->nama;
        $promo->tipe = $request->tipe;
        $promo->nilai = $request->nilai;
        $promo->mulai = $request->mulai;
        $promo->berakhir = $request->berakhir;
        $promo->save();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil diupdate!');
    }
    public function edit($id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $promo = Promo::findOrFail($id);
        return view('promo.edit', compact('promo'));
    }
    public function index()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $promos = Promo::orderBy('created_at', 'desc')->get();
        return view('promo.index', compact('promos'));
    }

    public function create()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        return view('promo.create');
    }

    public function store(Request $request)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'kode' => 'required|unique:promo,kode',
            'nama' => 'required',
            'tipe' => 'required|in:persen,nominal',
            'nilai' => 'required|integer|min:1',
            'mulai' => 'nullable|date',
            'berakhir' => 'nullable|date|after_or_equal:mulai',
        ]);
        // Validasi nilai promo persen tidak boleh lebih dari 100
        if ($request->tipe === 'persen' && $request->nilai > 100) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nilai' => 'Nilai promo persen tidak boleh lebih dari 100.']);
        }
        Promo::create($request->all());
        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }


    // AJAX: Update status aktif promo
    public function updateAktif($id, Request $request)
    {
        if (!session('kasir_logged_in')) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }
        $promo = Promo::findOrFail($id);
        $promo->aktif = $request->input('aktif') ? 1 : 0;
        $promo->save();
        return response()->json(['success' => true]);
    }
}
