@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex justify-content-between align-items-center">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3">
                <h6 class="text-white text-capitalize m-0">Daftar Pelanggan</h6>
            </div>
            <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#modalPelanggan" id="btnTambahPelanggan">Tambah Pelanggan</button>
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
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelanggan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit-pelanggan" 
                                    data-id="{{ $p->id }}" 
                                    data-nama="{{ $p->nama }}" 
                                    data-no_hp="{{ $p->no_hp }}" 
                                    data-alamat="{{ $p->alamat }}"
                                    data-bs-toggle="modal" data-bs-target="#modalPelanggan">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm btn-hapus-pelanggan" 
                                    data-id="{{ $p->id }}" 
                                    data-nama="{{ $p->nama }}"
                                    data-bs-toggle="modal" data-bs-target="#modalHapusPelanggan">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Pelanggan -->
<div class="modal fade" id="modalPelanggan" tabindex="-1" aria-labelledby="modalPelangganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPelanggan" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPelangganLabel">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSimpanPelanggan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Pelanggan -->
<div class="modal fade" id="modalHapusPelanggan" tabindex="-1" aria-labelledby="modalHapusPelangganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formHapusPelanggan" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusPelangganLabel">Hapus Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus pelanggan <b id="namaHapusPelanggan"></b>?</p>
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
        // Tambah pelanggan
        document.getElementById('btnTambahPelanggan').addEventListener('click', function() {
                document.getElementById('modalPelangganLabel').innerText = 'Tambah Pelanggan';
                document.getElementById('formPelanggan').reset();
                document.getElementById('formPelanggan').action = "{{ route('pelanggan.store') }}";
                document.getElementById('formMethod').value = 'POST';
        });

        // Edit pelanggan
        document.querySelectorAll('.btn-edit-pelanggan').forEach(function(btn) {
                btn.addEventListener('click', function() {
                        document.getElementById('modalPelangganLabel').innerText = 'Edit Pelanggan';
                        document.getElementById('nama').value = btn.getAttribute('data-nama');
                        document.getElementById('no_hp').value = btn.getAttribute('data-no_hp');
                        document.getElementById('alamat').value = btn.getAttribute('data-alamat');
                        document.getElementById('formPelanggan').action = `/pelanggan/update/${btn.getAttribute('data-id')}`;
                        document.getElementById('formMethod').value = 'PUT';
                });
        });

        // Hapus pelanggan
        document.querySelectorAll('.btn-hapus-pelanggan').forEach(function(btn) {
                btn.addEventListener('click', function() {
                        document.getElementById('namaHapusPelanggan').innerText = btn.getAttribute('data-nama');
                        document.getElementById('formHapusPelanggan').action = `/pelanggan/delete/${btn.getAttribute('data-id')}`;
                });
        });
});
</script>
@endpush

@endsection
