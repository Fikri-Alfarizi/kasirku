<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <title>Kasirku - Admin</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Main CSS -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Custom SweetAlert2 for iPhone-like modern look */
        .swal2-popup {
            border-radius: 28px !important;
            background: #fff !important;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15) !important;
            border: 1px solid #f0f0f0 !important;
            padding: 2.5em 2em !important;
        }
        .swal2-title {
            color: #222 !important;
            font-weight: 600 !important;
            font-size: 1.5rem !important;
            margin-bottom: 0.5em !important;
        }
        .swal2-html-container, .swal2-content {
            color: #444 !important;
            font-size: 1.1rem !important;
        }
        .swal2-icon.swal2-success {
            border-color: #4cd964 !important;
            color: #4cd964 !important;
        }
        .swal2-success-circular-line-left, .swal2-success-circular-line-right, .swal2-success-fix {
            background-color: #fff !important;
        }
        .swal2-actions button {
            border-radius: 18px !important;
            font-weight: 500 !important;
            padding: 0.6em 2em !important;
        }

    input.form-control[type="text"],
    input.form-control[type="number"],
    textarea.form-control {
        border: 1px solid #ced4da !important;
        background: #fff;
        box-shadow: none;
    }

        input.form-control,
    select.form-control,
    textarea.form-control {
        border: 1px solid #ced4da !important;
        background: #fff;
        box-shadow: none;
    }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <main class="main-content border-radius-lg">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>

                    <ul class="navbar-nav justify-content-end">


                        <!-- Login -->
                        @if(!session('kasir_logged_in'))
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ url('/login') }}" class="nav-link px-3 py-1 font-weight-bold rounded-pill d-flex align-items-center" style="margin-left:8px;background:#111;color:#fff;border:1.5px solid #111;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                                <i class="fa fa-user me-sm-1" style="color:#fff;"></i>
                                <span class="d-sm-inline d-none" style="color:#fff;">Login</span>
                            </a>
                        </li>
                        @else
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a href="#" class="nav-link px-2 py-1 font-weight-bold rounded-pill d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:8px;background:#111;color:#fff;border:1.5px solid #111;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                                <i class="fa fa-user-circle me-2" style="font-size:22px;color:#fff;"></i>
                                <span class="d-sm-inline d-none" style="color:#fff;">{{ session('kasir_name', 'Kasir') }}</span>
                                <i class="fa fa-caret-down ms-2" style="color:#fff;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2 shadow" aria-labelledby="userDropdown" style="min-width:160px;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#" style="font-size:15px;">
                                        <i class="fa fa-user me-2 text-primary"></i> Profil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();" style="font-size:15px;">
                                        <i class="fa fa-sign-out-alt me-2 text-danger"></i> Logout
                                    </a>
                                    <form id="logout-form-navbar" action="{{ route('logout') }}" method="GET" style="display: none;">@csrf</form>
                                </li>
                            </ul>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        {{-- MAIN CONTENT --}}
        @yield('content')
        {{-- atau kalau kamu masih memakai satu file --}}
        {{-- @include('dashboard') --}}
        {{-- tinggal aktifkan yang kamu mau --}}

    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var profilBtn = document.querySelector('a.dropdown-item[href="#"]');
            if (profilBtn) {
                profilBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var modal = new bootstrap.Modal(document.getElementById('modalProfilKasir'));
                    modal.show();
                });
            <!-- Modal Promo Kode (iPhone style, kecil) -->
            @if(session('show_promo_modal'))
            <div class="modal fade" id="modalPromoKode" tabindex="-1" aria-labelledby="modalPromoKodeLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:340px;">
                    <div class="modal-content" style="border-radius: 26px; box-shadow: 0 4px 24px rgba(30,60,114,0.13);">
                        <div class="modal-header justify-content-center" style="border-top-left-radius:26px;border-top-right-radius:26px;background:linear-gradient(90deg,#1e3c72 0%,#2a5298 100%);color:#fff;min-height:54px;">
                            <span class="mx-auto" style="font-size:1.15rem;font-weight:600;display:flex;align-items:center;gap:8px;">
                                <i class="fa fa-gift"></i> Kode Promo
                            </span>
                        </div>
                        <div class="modal-body text-center p-3">
                            <div class="mb-2">
                                <span class="badge bg-gradient-primary" style="font-size:1.01rem;padding:8px 18px;border-radius:14px;letter-spacing:1.2px;box-shadow:0 1px 4px rgba(30,60,114,0.10);">PROMO2025</span>
                            </div>
                            <div class="mb-1" style="font-size:0.98rem; color:#222; font-weight:500;">Diskon spesial transaksi pertama!</div>
                            <div class="text-secondary mb-2" style="font-size:0.91rem;">Berlaku 1x untuk pengguna baru.</div>
                            <button type="button" class="btn btn-primary w-100 mt-2 py-2" data-bs-dismiss="modal" style="border-radius:12px;font-weight:600;font-size:0.97rem;">Oke, Mengerti</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Modal Promo Kode (iPhone style, kecil) -->
            @if(session('show_promo_modal'))
            <div class="modal fade" id="modalPromoKode" tabindex="-1" aria-labelledby="modalPromoKodeLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:340px;">
                    <div class="modal-content" style="border-radius: 26px; box-shadow: 0 4px 24px rgba(30,60,114,0.13);">
                        <div class="modal-header justify-content-center" style="border-top-left-radius:26px;border-top-right-radius:26px;background:linear-gradient(90deg,#1e3c72 0%,#2a5298 100%);color:#fff;min-height:54px;">
                            <span class="mx-auto" style="font-size:1.15rem;font-weight:600;display:flex;align-items:center;gap:8px;">
                                <i class="fa fa-gift"></i> Kode Promo
                            </span>
                        </div>
                        <div class="modal-body text-center p-3">
                            <div class="mb-2">
                                <span class="badge bg-gradient-primary" style="font-size:1.01rem;padding:8px 18px;border-radius:14px;letter-spacing:1.2px;box-shadow:0 1px 4px rgba(30,60,114,0.10);">PROMO2025</span>
                            </div>
                            <div class="mb-1" style="font-size:0.98rem; color:#222; font-weight:500;">Diskon spesial transaksi pertama!</div>
                            <div class="text-secondary mb-2" style="font-size:0.91rem;">Berlaku 1x untuk pengguna baru.</div>
                            <button type="button" class="btn btn-primary w-100 mt-2 py-2" data-bs-dismiss="modal" style="border-radius:12px;font-weight:600;font-size:0.97rem;">Oke, Mengerti</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            }

            // Modal Promo Kode otomatis muncul jika session show_promo_modal
            @if(session('show_promo_modal'))
            setTimeout(function() {
                var promoModal = new bootstrap.Modal(document.getElementById('modalPromoKode'));
                promoModal.show();
            }, 400);
            @endif
        });
        </script>
        @endpush
        @stack('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var profilBtn = document.querySelector('a.dropdown-item[href="#"]');
            if (profilBtn) {
                profilBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var modal = new bootstrap.Modal(document.getElementById('modalProfilKasir'));
                    modal.show();
                });
            }
            // Modal Promo Kode otomatis muncul jika session show_promo_modal
            @if(session('show_promo_modal'))
            setTimeout(function() {
                var promoModal = new bootstrap.Modal(document.getElementById('modalPromoKode'));
                promoModal.show();
            }, 400);
            @endif
        });
        </script>
