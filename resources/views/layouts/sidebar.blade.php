<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main"
    style="background: white !important; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all .2s ease-in-out;">
    <div class="sidenav-header sticky-top" style="z-index: 2; background: white !important; border-bottom: 1px solid #eee;">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/favicon.png') }}" class="navbar-brand-img h-100" alt="main_logo" style="max-height: 40px;">
            <span class="ms-2 font-weight-bold text-dark" style="font-size: 1.1rem;">Kasirku</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav" style="overflow: visible;">
            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('dashboard') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            {{-- Kasir --}}
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('penjualan.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('penjualan.index') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Kasir</span>
                </a>
            </li>
            {{-- Produk --}}
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('produk.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('produk.index') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Produk</span>
                </a>
            </li>
            {{-- Pelanggan --}}
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('pelanggan.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('pelanggan.index') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Pelanggan</span>
                </a>
            </li>
            {{-- Promo --}}
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('promo.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('promo.index') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="material-icons opacity-10">local_offer</i>
                    </div>
                    <span class="nav-link-text ms-1">Promo</span>
                </a>
            </li>
            {{-- Laporan Penjualan --}}
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('laporan.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('laporan.index') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="material-icons opacity-10">bar_chart</i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
        </ul>
        <div style="position: absolute; left: 0; bottom: 0; width: 100%; padding: 16px 0; z-index: 10; background: white;">
            <a class="nav-link text-dark d-flex align-items-center" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="text-center me-2 d-flex align-items-center justify-content-center" style="color: black;">
                    <i class="material-icons opacity-10">logout</i>
                </div>
                <span class="nav-link-text ms-1">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</aside>