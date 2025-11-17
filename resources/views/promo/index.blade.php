@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card my-4 border-0 bg-transparent">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex justify-content-between align-items-center bg-transparent border-0">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3">
                <h6 class="text-white text-capitalize m-0">Daftar Promo</h6>
            </div>
            <a href="{{ route('promo.create') }}" class="btn btn-primary m-3">Tambah Promo</a>
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
            <div class="row g-4 p-3">
                @forelse($promos as $promo)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 rounded-4 position-relative promo-card">
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-gradient-primary px-3 py-2">{{ $promo->kode }}</span>
                                <div class="form-check form-switch ms-2">
                                    <input class="form-check-input promo-switch" type="checkbox" role="switch" data-id="{{ $promo->id }}" {{ $promo->aktif ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2">{{ $promo->aktif ? 'ON' : 'OFF' }}</label>
                                </div>
                            </div>
                            <h5 class="card-title mb-1" style="font-size:1.1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $promo->nama }}">{{ \Illuminate\Support\Str::limit($promo->nama, 28) }}</h5>
                            <div class="mb-1 text-primary fw-bold" style="font-size:1.05rem;">
                                @if($promo->tipe=='persen')
                                    {{ $promo->nilai }}%
                                @else
                                    Rp{{ number_format($promo->nilai,0,',','.') }}
                                @endif
                            </div>
                            <div class="mb-1"><span class="badge bg-gradient-info">Tipe: {{ ucfirst($promo->tipe) }}</span></div>
                            <div class="mb-1">
                                <span class="badge bg-gradient-success berlaku-badge" title="@if($promo->mulai && $promo->berakhir)Berlaku: {{ $promo->mulai }} s/d {{ $promo->berakhir }}@else - @endif">
                                    Berlaku: @if($promo->mulai && $promo->berakhir){{ $promo->mulai }} s/d {{ $promo->berakhir }}@else - @endif
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between gap-2 pb-3 pt-0">
                            <a href="{{ route('promo.edit', $promo->id) }}" class="btn btn-warning btn-sm rounded-3 px-3">Edit</a>
                            <form action="{{ route('promo.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm rounded-3 px-3 btn-hapus-promo">Hapus</button>
                                        <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            document.querySelectorAll('.btn-hapus-promo').forEach(function(btn) {
                                                btn.addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    const form = btn.closest('form');
                                                    Swal.fire({
                                                        title: 'Yakin ingin menghapus?',
                                                        text: 'Data promo akan dihapus permanen!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ya, hapus!',
                                                        cancelButtonText: 'Batal',
                                                        background: '#fff',
                                                        color: '#222',
                                                        customClass: {
                                                            popup: 'swal2-popup',
                                                            title: 'swal2-title',
                                                            content: 'swal2-html-container',
                                                            confirmButton: 'swal2-confirm',
                                                            cancelButton: 'swal2-cancel',
                                                        }
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            form.submit();
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                        </script>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada promo.</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .promo-card {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .promo-card:hover {
        box-shadow: 0 8px 32px 0 rgba(30,60,114,0.13), 0 1.5px 6px 0 rgba(30,60,114,0.10);
        transform: translateY(-4px) scale(1.02);
        z-index: 2;
    }
    .promo-card .btn {
        min-width: 70px;
    }
    .berlaku-badge {
        max-width: 170px;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }
    @media (max-width: 575.98px) {
        .promo-card { font-size: 0.97rem; }
        .berlaku-badge { max-width: 110px; }
    }
</style>
@endpush
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.promo-switch').forEach(function(switchEl) {
        switchEl.addEventListener('change', function() {
            const promoId = this.getAttribute('data-id');
            const aktif = this.checked ? 1 : 0;
            fetch(`/promo/${promoId}/aktif`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ aktif })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    this.nextElementSibling.textContent = aktif ? 'ON' : 'OFF';
                } else {
                    alert('Gagal update status promo!');
                    this.checked = !aktif;
                }
            })
            .catch(() => {
                alert('Gagal update status promo!');
                this.checked = !aktif;
            });
        });
    });
});
</script>
@endsection
