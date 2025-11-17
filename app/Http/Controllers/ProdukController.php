<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
    // Tambahkan pengecekan login di edit, update, destroy

{
    // ==========================
    // LIST PRODUK
    // ==========================
    public function index()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    // ==========================
    // FORM TAMBAH PRODUK
    // ==========================
    public function create()
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        return view('produk.create');
    }

    // ==========================
    // SIMPAN PRODUK
    // ==========================
    public function store(Request $request)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'deskripsi'   => 'nullable',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_url'  => 'nullable|url',
        ]);
        $gambar = 'img/noimg.jpg'; // default
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/produk'), $namaFile);
            $gambar = 'img/produk/' . $namaFile;
        } elseif ($request->filled('gambar_url')) {
            $gambar = $request->gambar_url;
        }
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
        ]);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // ==========================
    // FORM EDIT PRODUK
    // ==========================
    public function edit($id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // ==========================
    // UPDATE PRODUK
    // ==========================
    public function update(Request $request, $id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $request->validate([
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'deskripsi'   => 'nullable',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_url'  => 'nullable|url',
        ]);
        $produk = Produk::findOrFail($id);
        $gambar = $produk->gambar;
        if ($request->hasFile('gambar')) {
            // hapus file lama jika file lokal
            if ($produk->gambar && $produk->gambar != 'img/noimg.jpg' && !filter_var($produk->gambar, FILTER_VALIDATE_URL)) {
                $oldPath = public_path($produk->gambar);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/produk'), $namaFile);
            $gambar = 'img/produk/' . $namaFile;
        } elseif ($request->filled('gambar_url')) {
            // hapus file lama jika file lokal
            if ($produk->gambar && $produk->gambar != 'img/noimg.jpg' && !filter_var($produk->gambar, FILTER_VALIDATE_URL)) {
                $oldPath = public_path($produk->gambar);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $gambar = $request->gambar_url;
        }
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambar,
        ]);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // ==========================
    // HAPUS PRODUK
    // ==========================
    public function destroy($id)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }
        $produk = Produk::findOrFail($id);
        if ($produk->gambar && $produk->gambar != 'img/noimg.jpg') {
            $path = public_path($produk->gambar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
