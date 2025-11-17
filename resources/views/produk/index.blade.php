@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card my-4 border-0 bg-transparent">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex justify-content-between align-items-center bg-transparent border-0">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3">
                <h6 class="text-white text-capitalize m-0">Daftar Produk</h6>
            </div>
            <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#modalProduk" id="btnTambahProduk">+ Tambah Produk</button>
        </div>
        <div class="card-body px-0 pb-2">
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 1800,
                            background: '#fff',
                            color: '#222',
                            customClass: {
                                popup: 'swal2-popup',
                                title: 'swal2-title',
                                content: 'swal2-html-container',
                            }
                        });
                    });
                </script>
            @endif
            <div class="row g-4 p-3">
                @forelse ($produk as $p)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 rounded-4 position-relative product-card">
                        <img src="{{ asset($p->gambar) }}" class="card-img-top object-fit-cover rounded-4" alt="{{ $p->nama_produk }}" style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
                        <div class="card-body pb-2">
                            <h5 class="card-title mb-1" style="font-size:1.1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $p->nama_produk }}">{{ \Illuminate\Support\Str::limit($p->nama_produk, 28) }}</h5>
                            <div class="mb-1 text-primary fw-bold" style="font-size:1.05rem;">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                            <div class="mb-1"><span class="badge bg-gradient-info">Stok: {{ $p->stok }}</span></div>
                            <p class="card-text text-muted mb-2" style="font-size:0.97rem;min-height:38px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $p->deskripsi }}">{{ \Illuminate\Support\Str::limit($p->deskripsi, 38) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between gap-2 pb-3 pt-0">
                            <button class="btn btn-warning btn-sm rounded-3 px-3 btn-edit-produk"
                                data-id="{{ $p->id }}"
                                data-nama_produk="{{ $p->nama_produk }}"
                                data-harga="{{ $p->harga }}"
                                data-stok="{{ $p->stok }}"
                                data-deskripsi="{{ $p->deskripsi }}"
                                data-gambar="{{ $p->gambar }}"
                                data-bs-toggle="modal" data-bs-target="#modalProduk">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm rounded-3 px-3 btn-hapus-produk"
                                data-id="{{ $p->id }}"
                                data-nama_produk="{{ $p->nama_produk }}"
                                data-bs-toggle="modal" data-bs-target="#modalHapusProduk">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada produk.</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .product-card {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .product-card:hover {
        box-shadow: 0 8px 32px 0 rgba(30,60,114,0.13), 0 1.5px 6px 0 rgba(30,60,114,0.10);
        transform: translateY(-4px) scale(1.02);
        z-index: 2;
    }
    .product-card .card-img-top {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .product-card .btn {
        min-width: 70px;
    }
    @media (max-width: 575.98px) {
        .product-card .card-img-top { height: 120px; }
    }
</style>
@endpush

<!-- Modal Tambah/Edit Produk -->
<div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="modalProdukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formProduk" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formProdukMethod" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProdukLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk (Upload)</label>
                        <input type="file" class="form-control mb-2" id="gambar" name="gambar">
                        <label for="gambar_url" class="form-label">atau Link URL Gambar</label>
                        <input type="url" class="form-control mb-2" id="gambar_url" name="gambar_url" placeholder="https://...">
                        <img id="previewGambar" src="" alt="Preview Gambar" class="img-fluid mt-2 d-none" style="max-height:120px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSimpanProduk">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Produk -->
<div class="modal fade" id="modalHapusProduk" tabindex="-1" aria-labelledby="modalHapusProdukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formHapusProduk" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusProdukLabel">Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus produk <b id="namaHapusProduk"></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
        // Tambah produk
        document.getElementById('btnTambahProduk').addEventListener('click', function() {
                document.getElementById('modalProdukLabel').innerText = 'Tambah Produk';
                document.getElementById('formProduk').reset();
                document.getElementById('formProduk').action = "{{ route('produk.store') }}";
                document.getElementById('formProdukMethod').value = 'POST';
                document.getElementById('previewGambar').classList.add('d-none');
                document.getElementById('gambar_url').value = '';
        });

        // Edit produk
        document.querySelectorAll('.btn-edit-produk').forEach(function(btn) {
                btn.addEventListener('click', function() {
                        document.getElementById('modalProdukLabel').innerText = 'Edit Produk';
                        document.getElementById('nama_produk').value = btn.getAttribute('data-nama_produk');
                        document.getElementById('harga').value = btn.getAttribute('data-harga');
                        document.getElementById('stok').value = btn.getAttribute('data-stok');
                        document.getElementById('deskripsi').value = btn.getAttribute('data-deskripsi');
                        document.getElementById('formProduk').action = `/produk/${btn.getAttribute('data-id')}`;
                        document.getElementById('formProdukMethod').value = 'PUT';
                        // Preview gambar jika ada
                        let gambar = btn.getAttribute('data-gambar');
                        if(gambar) {
                            // Cek apakah gambar adalah URL atau path lokal
                            if(gambar.startsWith('http')) {
                                document.getElementById('previewGambar').src = gambar;
                                document.getElementById('gambar_url').value = gambar;
                            } else {
                                document.getElementById('previewGambar').src = `/${gambar}`;
                                document.getElementById('gambar_url').value = '';
                            }
                            document.getElementById('previewGambar').classList.remove('d-none');
                        } else {
                            document.getElementById('previewGambar').classList.add('d-none');
                            document.getElementById('gambar_url').value = '';
                        }
                    // Preview gambar dari input URL
                    document.getElementById('gambar_url').addEventListener('input', function() {
                        const url = this.value;
                        if(url && (url.startsWith('http://') || url.startsWith('https://'))){
                            document.getElementById('previewGambar').src = url;
                            document.getElementById('previewGambar').classList.remove('d-none');
                        } else {
                            document.getElementById('previewGambar').classList.add('d-none');
                        }
                    });
                });
        });

        // Hapus produk
        document.querySelectorAll('.btn-hapus-produk').forEach(function(btn) {
                btn.addEventListener('click', function() {
                        document.getElementById('namaHapusProduk').innerText = btn.getAttribute('data-nama_produk');
                        document.getElementById('formHapusProduk').action = `/produk/${btn.getAttribute('data-id')}`;
                });
        });
});
</script>
@endpush

@endsection
