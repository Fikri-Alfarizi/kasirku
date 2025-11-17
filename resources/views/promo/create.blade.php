@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex align-items-center">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3">
                <h6 class="text-white text-capitalize m-0">Tambah Promo</h6>
            </div>
        </div>
        <div class="card-body px-4 pb-4 pt-4">
                        @if(session('success'))
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
            <form method="POST" action="{{ route('promo.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="kode" class="form-label">Kode Promo</label>
                        <input type="text" id="kode" name="kode" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Promo</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tipe" class="form-label">Tipe Diskon</label>
                        <select id="tipe" name="tipe" class="form-control" required>
                            <option value="persen">Persen (%)</option>
                            <option value="nominal">Nominal (Rp)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nilai" class="form-label">Nilai Diskon</label>
                        <input type="number" id="nilai" name="nilai" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <label for="mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="mulai" name="mulai" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="berakhir" class="form-label">Tanggal Berakhir</label>
                        <input type="date" id="berakhir" name="berakhir" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="aktif" class="form-label">Status Aktif</label>
                        <select id="aktif" name="aktif" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Promo</button>
                    <a href="{{ route('promo.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
