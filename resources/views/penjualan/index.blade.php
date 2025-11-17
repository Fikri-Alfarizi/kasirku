@php
    if (!session('kasir_logged_in')) {
        header('Location: /login');
        exit;
    }
@endphp
@extends('layouts.master')

@section('content')
<style>
/* Search Produk Kasir */
.search-produk-wrapper {
    position: relative;
    max-width: 100%;
    margin-bottom: 24px;
}
.search-produk-input {
    width: 100%;
    padding: 16px 48px 16px 48px;
    font-size: 1.15rem;
    border-radius: 14px;
    border: 1.5px solid #eee;
    background: #fff;
    box-shadow: 0 2px 8px rgba(102,126,234,0.07);
    transition: border .2s, box-shadow .2s;
}
.search-produk-input:focus {
    border: 1.5px solid #bbb;
    outline: none;
    box-shadow: 0 4px 16px rgba(102,126,234,0.09);
}
.search-produk-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.5rem;
    color: #667eea;
    pointer-events: none;
}
/* Perbesar produk utama dan tampilkan gambar */
.produk-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 32px;
    max-height: 68vh;
    overflow-y: auto;
    padding-right: 6px;
}
@media (max-width: 991px) {
    .produk-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 600px) {
    .produk-grid {
        grid-template-columns: 1fr;
    }
}
.produk-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.09);
    padding: 18px 12px 14px 12px;
    text-align: center;
    cursor: pointer;
    border: 2.5px solid transparent;
    transition: box-shadow .2s, border .2s;
    position: relative;
    min-height: 270px;
}
.produk-card:hover {
    border: 2.5px solid #667eea;
    box-shadow: 0 8px 24px rgba(102,126,234,0.18);
}
.produk-card .produk-img {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px;
    background: #f3f3f3;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.produk-card .stok {
    font-size: 13px;
    color: #888;
    margin-bottom: 4px;
}
.produk-card .harga {
    color: #667eea;
    font-weight: bold;
    margin-bottom: 4px;
    font-size: 18px;
}
.produk-card .nama {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}
.keranjang-panel {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    padding: 20px;
}
.keranjang-list {
    max-height: 320px;
    overflow-y: auto;
    margin-bottom: 16px;
}
.keranjang-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #eee;
    padding: 8px 0;
}
.keranjang-item:last-child {
    border-bottom: none;
}
.keranjang-nama {
    font-weight: 600;
}
.keranjang-qty {
    width: 50px;
    text-align: right;
}
.keranjang-total {
    font-weight: bold;
    color: #667eea;
}
.input-bayar {
    width: 120px;
    display: inline-block;
    margin-left: 8px;
}
.kembalian {
    font-weight: bold;
    color: #28a745;
}
</style>

<div class="container mt-4">

    <h2 class="mb-4">Transaksi Penjualan</h2>
    <div class="search-produk-wrapper">
        <span class="search-produk-icon"><i class="fa fa-search"></i></span>
        <input type="text" id="searchProduk" class="search-produk-input" placeholder="Cari produk..." autocomplete="off">
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-7">
            <div class="produk-grid">
                @foreach($produk as $pr)
                <div class="produk-card" data-id="{{ $pr->id }}" data-nama="{{ $pr->nama_produk }}" data-harga="{{ $pr->harga }}" data-stok="{{ $pr->stok }}">
                    <img class="produk-img" src="{{ asset($pr->gambar ?: 'img/noimg.jpg') }}" alt="{{ $pr->nama_produk }}">
                    <div class="nama">{{ $pr->nama_produk }}</div>
                    <div class="harga">Rp {{ number_format($pr->harga,0,',','.') }}</div>
                    <div class="stok">Stok: {{ $pr->stok }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-5">
            <div class="keranjang-panel shadow-lg p-4" style="background:linear-gradient(135deg,#f8fafc 80%,#e0e7ff 100%);">
                <form method="POST" action="{{ route('penjualan.store') }}" id="formKasir">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="selectPelanggan"><i class="fas fa-user"></i> Pelanggan</label>
                        <select name="id_pelanggan" class="form-select form-select-lg rounded-3 border-primary shadow-sm" id="selectPelanggan" required>
                            <option value="" disabled selected>-- Pilih Pelanggan --</option>
                            @foreach($pelanggan as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="keranjang-list mb-3 px-1 py-2 rounded-3 border border-2 border-light bg-white shadow-sm" id="keranjangList" style="min-height:70px;">
                        <div class="text-muted text-center">Keranjang kosong</div>
                    </div>
                    <input type="hidden" name="keranjang" id="keranjangInput" value="[]">
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="inputPromo"><i class="fas fa-gift"></i> Kode Promo</label>
                        <input type="text" class="form-control form-control-lg rounded-3 border-info shadow-sm" name="kode_promo" id="inputPromo" placeholder="Masukkan kode promo">
                    </div>
                    <div class="mb-2 row g-2 align-items-center">
                        <div class="col-7 text-secondary small">Total</div>
                        <div class="col-5 text-end keranjang-total fs-5" id="totalKeranjang">Rp 0</div>
                    </div>
                    <div class="mb-2 row g-2 align-items-center">
                        <div class="col-7 text-success small">Diskon</div>
                        <div class="col-5 text-end keranjang-total text-success fs-6" id="diskonPromo">Rp 0</div>
                    </div>
                    <div class="mb-2 row g-2 align-items-center">
                        <div class="col-7 fw-bold small">Total Setelah Diskon</div>
                        <div class="col-5 text-end keranjang-total fw-bold fs-5" id="totalSetelahDiskon">Rp 0</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="inputBayar"><i class="fas fa-money-bill-wave"></i> Bayar</label>
                        <input type="number" min="0" class="form-control form-control-lg rounded-3 border-success shadow-sm input-bayar" name="bayar" id="inputBayar" placeholder="0" required>
                    </div>
                    <div class="mb-4 row g-2 align-items-center">
                        <div class="col-7 fw-bold text-success">Kembalian</div>
                        <div class="col-5 text-end kembalian fs-5" id="kembalian">Rp 0</div>
                    </div>
                    <button type="submit" class="btn w-100 py-3 fs-5 rounded-3 shadow" id="btnBayar" disabled style="background:#111;color:#fff;font-weight:700;letter-spacing:1px;">
                        <i class="fas fa-print me-2"></i> Simpan & Cetak Struk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

// Search produk
document.getElementById('searchProduk').addEventListener('input', function() {
    const q = this.value.trim().toLowerCase();
    document.querySelectorAll('.produk-card').forEach(card => {
        const nama = card.dataset.nama.toLowerCase();
        if (nama.includes(q)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});

let keranjang = [];
let diskonPromo = 0;
let totalSetelahDiskon = 0;
let kodePromoValid = '';

function updateKeranjang() {
    const list = document.getElementById('keranjangList');
    const totalEl = document.getElementById('totalKeranjang');
    const inputKeranjang = document.getElementById('keranjangInput');
    const btnBayar = document.getElementById('btnBayar');
    const diskonEl = document.getElementById('diskonPromo');
    const totalDiskonEl = document.getElementById('totalSetelahDiskon');
    let total = 0;
    list.innerHTML = '';
    if (keranjang.length === 0) {
        list.innerHTML = '<div class="text-muted text-center">Keranjang kosong</div>';
        totalEl.textContent = 'Rp 0';
        diskonEl.textContent = 'Rp 0';
        totalDiskonEl.textContent = 'Rp 0';
        inputKeranjang.value = '[]';
        btnBayar.disabled = true;
        updateKembalian();
        return;
    }
    keranjang.forEach((item, idx) => {
        total += item.harga * item.qty;
        list.innerHTML += `
            <div class='keranjang-item'>
                <span class='keranjang-nama'>${item.nama}</span>
                <input type='number' min='1' max='${item.stok}' value='${item.qty}' class='form-control keranjang-qty' data-idx='${idx}' style='width:60px;display:inline-block;'>
                <span>x Rp ${item.harga.toLocaleString()}</span>
                <span>= Rp ${(item.harga*item.qty).toLocaleString()}</span>
                <button type='button' class='btn btn-danger btn-sm ms-2 btn-hapus' data-idx='${idx}'>Hapus</button>
            </div>
        `;
    });
    totalEl.textContent = 'Rp ' + total.toLocaleString();
    // Hitung diskon promo jika ada
    hitungPromo(total);
    diskonEl.textContent = 'Rp ' + diskonPromo.toLocaleString();
    totalDiskonEl.textContent = 'Rp ' + totalSetelahDiskon.toLocaleString();
    inputKeranjang.value = JSON.stringify(keranjang);
    btnBayar.disabled = false;
    updateKembalian();
}

function hitungPromo(total) {
    const kode = document.getElementById('inputPromo').value.trim();
    diskonPromo = 0;
    totalSetelahDiskon = total;
    kodePromoValid = '';
    if (kode.length > 0 && window.promos) {
        const promo = window.promos.find(p => p.kode.toLowerCase() === kode.toLowerCase() && p.aktif);
        if (promo) {
            if (promo.tipe === 'persen') {
                diskonPromo = Math.floor(total * promo.nilai / 100);
            } else {
                diskonPromo = Math.min(promo.nilai, total);
            }
            totalSetelahDiskon = total - diskonPromo;
            kodePromoValid = promo.kode;
        }
    }
}

function updateKembalian() {
    const bayar = parseInt(document.getElementById('inputBayar').value) || 0;
    const kembalian = bayar - totalSetelahDiskon;
    document.getElementById('kembalian').textContent = 'Rp ' + (kembalian >= 0 ? kembalian.toLocaleString() : '0');
    document.getElementById('btnBayar').disabled = keranjang.length === 0 || bayar < totalSetelahDiskon;
}

// Tambah produk ke keranjang
document.querySelectorAll('.produk-card').forEach(card => {
    card.addEventListener('click', function() {
        const id = parseInt(this.dataset.id);
        const nama = this.dataset.nama;
        const harga = parseInt(this.dataset.harga);
        const stok = parseInt(this.dataset.stok);
        let item = keranjang.find(i => i.id === id);
        if (item) {
            if (item.qty < stok) item.qty++;
        } else {
            if (stok > 0) keranjang.push({id, nama, harga, qty:1, stok});
        }
        updateKeranjang();
    });
});

// Ubah qty di keranjang
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('keranjang-qty')) {
        const idx = parseInt(e.target.dataset.idx);
        let val = parseInt(e.target.value);
        if (val < 1) val = 1;
        if (val > keranjang[idx].stok) val = keranjang[idx].stok;
        keranjang[idx].qty = val;
        updateKeranjang();
    }
});

// Hapus item keranjang
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-hapus')) {
        const idx = parseInt(e.target.dataset.idx);
        keranjang.splice(idx, 1);
        updateKeranjang();
    }
});


// Update promo saat input kode promo berubah
document.getElementById('inputPromo').addEventListener('input', function() {
    updateKeranjang();
});

// Update kembalian saat input bayar berubah
document.getElementById('inputBayar').addEventListener('input', updateKembalian);


// Validasi sebelum submit

document.getElementById('formKasir').addEventListener('submit', function(e) {
    e.preventDefault();
    if (keranjang.length === 0) {
        alert('Keranjang kosong!');
        return;
    }
    const bayar = parseInt(document.getElementById('inputBayar').value) || 0;
    if (bayar < totalSetelahDiskon) {
        alert('Nominal bayar kurang dari total!');
        return;
    }
    document.getElementById('inputPromo').value = kodePromoValid || document.getElementById('inputPromo').value.trim();

    // Submit via AJAX agar bisa buka struk di tab baru
    const form = this;
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(res => res.redirected ? res : res.json())
    .then(res => {
        // Jika redirect, ambil url struk dari res.url
        if (res.redirected && res.url) {
            window.open(res.url, '_blank');
            form.reset();
            keranjang = [];
            updateKeranjang();
            updateKembalian();
        } else if (res.error) {
            alert(res.error);
        }
    })
    .catch(() => alert('Terjadi kesalahan, coba lagi.'));
});

// Ambil data promo dari backend (window.promos)
window.promos = @json($promos);

updateKeranjang();
</script>
@endsection
