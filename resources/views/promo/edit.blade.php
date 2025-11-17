@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Edit Promo</h6>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
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
            <div class="container">
                <form action="{{ route('promo.update', $promo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Promo</label>
                                <input type="text" id="kode" name="kode" class="form-control" value="{{ old('kode', $promo->kode) }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Promo</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $promo->nama) }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe Promo</label>
                                <select id="tipe" name="tipe" class="form-control" required>
                                    <option value="persen" {{ old('tipe', $promo->tipe)=='persen' ? 'selected' : '' }}>Persen (%)</option>
                                    <option value="nominal" {{ old('tipe', $promo->tipe)=='nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai Promo</label>
                                <input type="number" id="nilai" name="nilai" class="form-control" value="{{ old('nilai', $promo->nilai) }}" required min="1">
                                @error('nilai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="mulai" class="form-label">Mulai Berlaku</label>
                                <input type="date" id="mulai" name="mulai" class="form-control" value="{{ old('mulai', $promo->mulai) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="berakhir" class="form-label">Berakhir</label>
                                <input type="date" id="berakhir" name="berakhir" class="form-control" value="{{ old('berakhir', $promo->berakhir) }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check my-3">
                                <input type="checkbox" class="form-check-input" id="aktif" name="aktif" value="1" {{ old('aktif', $promo->aktif) ? 'checked' : '' }}>
                                <label class="form-check-label" for="aktif">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('promo.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
