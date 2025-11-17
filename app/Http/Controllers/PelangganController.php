<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Tampilkan semua pelanggan
    public function index()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    // Form tambah pelanggan
    public function create()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        return view('pelanggan.create');
    }

    // Simpan pelanggan baru
    public function store(Request $request)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    // Form edit pelanggan
    public function edit($id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Update pelanggan
    public function update(Request $request, $id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);
        Pelanggan::findOrFail($id)->update($request->all());
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil diperbarui!');
    }

    // Hapus pelanggan
    public function destroy($id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil dihapus!');
    }
}
