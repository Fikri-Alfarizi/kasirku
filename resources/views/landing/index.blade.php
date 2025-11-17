<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasirku - Aplikasi Kasir Modern</title>
    <!-- Font: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Variabel Warna */
        :root {
            --primary-color: #4a4e69; /* Darker, sophisticated primary */
            --secondary-color: #1a1a2e; /* Very dark text/shadow */
            --accent-color: #667eea; /* Bright accent for hover/CTA */
            --light-bg: #f8f9fa; /* Light background */
            --soft-white: #ffffff;
            --soft-gray: #e9ecef;
        }

        /* Reset dan Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            /* Mengganti linear gradient di body agar lebih halus */
            background-color: var(--light-bg);
            min-height: 100vh;
            scroll-behavior: smooth;
            color: var(--primary-color);
        }

        /* Navbar Styling */
        .navbar {
            background: transparent;
            box-shadow: none;
            border-radius: 0;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800; /* Lebih tebal */
            color: var(--secondary-color) !important;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }
        .navbar-brand span {
            color: var(--accent-color);
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 600;
            margin: 0 12px;
            padding: 8px 0;
            transition: color .2s, border-bottom .2s;
            position: relative;
        }

        .nav-link.active, .nav-link:hover {
            color: var(--accent-color) !important;
        }

        .nav-link.active::after, .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px; /* Garis bawah lebih tebal */
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        /* Padding Universal */
        .section-padding {
            padding: 90px 0; /* Padding lebih besar */
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }

        .section-subtitle {
            font-size: 1.15rem;
            color: var(--primary-color);
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--soft-white) 0%, var(--soft-gray) 100%);
            padding: 120px 0 100px 0;
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--secondary-color);
            line-height: 1.2;
        }

        .hero-sub {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-bottom: 40px;
        }

        /* Button Styling (Konsisten) */
        .btn-cta {
            background: var(--accent-color);
            color: var(--soft-white);
            font-weight: 700;
            font-size: 1.1rem;
            padding: 16px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(102,126,234,0.3); /* Shadow accent */
            transition: all .3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: inline-block;
            text-decoration: none;
            border: none;
        }

        .btn-cta:hover {
            background: #4e6be0; /* Warna sedikit lebih gelap dari accent */
            color: var(--soft-white);
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(102,126,234,0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 14px 38px;
            border-radius: 12px;
            transition: all .3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: var(--soft-white);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 78, 105, 0.1);
        }

        /* Gambar Ilustrasi Hero */
        .hero-image {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(26,26,46,0.1);
            transition: transform 0.3s ease;
        }
        .hero-image:hover {
            transform: scale(1.02);
        }

        /* About Section (Perbaikan Fokus) */
        .about-section {
            padding: 90px 0;
            background: var(--soft-white);
        }

        .about-image {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); /* Shadow yang bersih */
            width: 100%;
            height: auto;
        }

        .about-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
            background: var(--soft-gray);
            border-radius: 12px;
            padding: 10px;
            margin-right: 20px;
            min-width: 55px; /* Menjaga ukuran ikon tetap */
            text-align: center;
        }

        .about-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding: 15px;
            border-radius: 12px;
            transition: background 0.3s;
        }

        .about-item:hover {
            background: rgba(102,126,234,0.05);
        }

        .about-content h5 {
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.3rem;
        }

        /* Features Section */
        .features-section {
            background: var(--light-bg);
            padding: 90px 0;
        }

        .feature-card {
            background: var(--soft-white);
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(26,26,46,0.05); /* Shadow lebih dalam */
            padding: 36px 28px;
            margin-bottom: 32px;
            min-height: 250px;
            transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--soft-gray);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(102,126,234,0.15); /* Hover shadow accent */
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 18px;
            display: inline-block;
        }

        .feature-card h5 {
            color: var(--secondary-color);
        }

        /* Screenshot Section */
        .screenshot-section {
            padding: 90px 0;
            background: var(--soft-white);
        }

        .screenshot-img {
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(26,26,46,0.1);
            margin-bottom: 24px;
            width: 100%;
            max-width: 450px;
            border: 1px solid var(--soft-gray);
        }

        /* Pricing Section */
        .pricing-section {
            background: var(--light-bg);
            padding: 90px 0;
        }

        .price-card {
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(26,26,46,0.07);
            background: var(--soft-white);
            padding: 40px 30px;
            margin-bottom: 32px;
            transition: all .3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--soft-gray);
        }

        .price-card:hover {
            box-shadow: 0 15px 40px rgba(102,126,234,0.1);
            transform: translateY(-8px);
        }

        .price-card.featured {
            border: 3px solid var(--accent-color);
            background: linear-gradient(145deg, var(--soft-white) 0%, rgba(102,126,234,0.05) 100%);
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(102,126,234,0.25);
        }

        .price-card.featured:hover {
            transform: scale(1.05) translateY(-8px);
        }

        .price-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .price-value {
            font-size: 3rem;
            font-weight: 800;
            color: var(--accent-color);
            margin-bottom: 2rem;
        }

        .price-features {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
            flex-grow: 1;
        }

        .price-features li {
            padding: 0.8rem 0;
            border-bottom: 1px dashed rgba(0,0,0,0.05); /* Garis putus-putus lebih lembut */
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Testimonial Section */
        .testimoni-section {
            padding: 90px 0;
            background: var(--soft-white);
        }

        .testi-card {
            background: var(--soft-white);
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(26,26,46,0.07);
            padding: 30px 25px;
            margin-bottom: 32px;
            min-height: 220px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-top: 5px solid var(--accent-color);
        }

        .testi-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(102,126,234,0.1);
        }

        .testi-photo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid var(--soft-gray);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .testi-name {
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .testi-rating {
            color: #ffc107; /* Warna Bintang */
            margin-bottom: 15px;
        }

        .testi-quote {
            font-style: italic;
            color: var(--primary-color);
            line-height: 1.6;
        }

        /* FAQ Section */
        .faq-section {
            background: var(--light-bg);
            padding: 90px 0;
        }

        .accordion-item {
            border-radius: 12px !important;
            margin-bottom: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .accordion-button {
            font-weight: 700;
            color: var(--secondary-color);
            padding: 18px 20px;
            transition: all 0.3s;
        }

        .accordion-button:not(.collapsed) {
            color: var(--soft-white);
            background-color: var(--accent-color);
            box-shadow: none;
        }

        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1); /* Ikon panah jadi putih saat aktif */
        }


        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
            border-color: transparent;
        }

        .accordion-body {
            color: var(--primary-color);
            background-color: var(--soft-white);
        }

        /* CTA Akhir */
        .cta-section {
            padding: 90px 0;
            background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, var(--soft-white) 100%);
            text-align: center;
        }

        .cta-section .section-title {
            color: var(--accent-color);
        }


        /* Footer */
        .footer {
            background: var(--secondary-color); /* Footer gelap */
            color: var(--soft-white);
            font-size: 1rem;
            padding: 50px 0 25px 0;
        }

        .footer-logo {
            font-weight: 800;
            color: var(--soft-white);
            font-size: 1.6rem;
            display: block;
        }

        .footer-logo span {
            color: var(--accent-color);
        }

        .footer-link {
            color: var(--soft-gray);
            margin: 0 10px;
            text-decoration: none;
            font-weight: 500;
            transition: color .2s;
        }

        .footer-link:hover {
            color: var(--accent-color);
        }

        .footer-social a {
            color: var(--accent-color);
            font-size: 1.5rem;
            margin-left: 20px;
            transition: color .2s;
        }

        .footer-social a:hover {
            color: var(--soft-white);
        }

        .footer-bottom-text {
            color: #adb5bd;
        }

        @media (max-width: 991px) {
            .hero-section, .about-section, .features-section, .screenshot-section, .pricing-section, .testimoni-section, .faq-section, .cta-section {
                padding: 60px 0;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .price-card.featured {
                transform: scale(1);
            }
        }

        @media (max-width: 767px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-sub {
                font-size: 1.1rem;
            }

            .hero-image {
                max-width: 300px;
            }

            .btn-cta {
                font-size: 1rem;
                padding: 12px 28px;
            }

            .footer-social {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="#">Kasir<span>ku</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center" id="home">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-7 text-lg-start text-center mb-5 mb-lg-0">
                    <h1 class="hero-title mb-3">Kelola Penjualan & Stok Produk Anda dengan <span class="text-accent-color">Mudah dan Cepat</span>.</h1>
                    <p class="hero-sub mb-4">Aplikasi kasir modern berbasis cloud untuk UMKM & Toko Online. Semua transaksi, stok, dan laporan otomatis dalam satu platform yang terintegrasi.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-cta">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-cta">Coba Gratis Sekarang</a>
                        @endauth
                        <a href="#features" class="btn btn-outline-primary">Lihat Fitur</a>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <!-- Ilustrasi yang lebih bersih dan modern -->
                    <img src="{{ asset('img/header.png') }}" alt="Ilustrasi Kasirku" class="img-fluid hero-image" style="max-width: 450px; background: none; border-radius: 0; box-shadow: none;">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section section-padding" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5 mb-md-0">
                    <!-- Ilustrasi tanpa kotak, shadow, dan background, hanya gambar polos -->
                    <img src="{{ asset('img/main.png') }}" alt="Tentang Kasirku" style="width: 100%; height: auto; background: none !important; border-radius: 0 !important; box-shadow: none !important; padding: 0 !important; margin: 0 auto; display: block;">
                </div>
                <div class="col-md-6 ps-md-5">
                    <h2 class="section-title">Kenapa Memilih Kasirku?</h2>
                    <p class="section-subtitle text-start mx-0">Kasirku hadir untuk membantu UMKM dan toko modern mengelola penjualan, stok, dan laporan secara otomatis, memberikan Anda waktu lebih untuk fokus pada pengembangan bisnis.</p>

                    <div class="about-item">
                        <span class="about-icon"><i class="bi bi-cloud-check-fill"></i></span>
                        <div class="about-content">
                            <h5>Berbasis Cloud & Real-Time</h5>
                            <p class="mb-0 text-muted">Akses data di mana saja, kapan saja. Stok dan laporan selalu ter-update secara real-time.</p>
                        </div>
                    </div>

                    <div class="about-item">
                        <span class="about-icon"><i class="bi bi-tablet-fill"></i></span>
                        <div class="about-content">
                            <h5>Multi-Platform (Responsif)</h5>
                            <p class="mb-0 text-muted">Dapat digunakan di smartphone, tablet, atau komputer tanpa perlu instalasi rumit.</p>
                        </div>
                    </div>

                    <div class="about-item">
                        <span class="about-icon"><i class="bi bi-shield-lock-fill"></i></span>
                        <div class="about-content">
                            <h5>Keamanan Data Terjamin</h5>
                            <p class="mb-0 text-muted">Data Anda disimpan aman dengan enkripsi tinggi dan backup otomatis harian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section section-padding" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Fitur Unggulan Kami</h2>
                <p class="section-subtitle">Semua yang Anda butuhkan untuk mengelola bisnis dengan lebih efisien</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="bi bi-cash-coin"></i></div>
                        <h5 class="fw-bold mb-2">Kasir Super Cepat (POS)</h5>
                        <p class="text-muted">Proses transaksi penjualan dalam hitungan detik. Mendukung pembayaran tunai dan non-tunai.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="bi bi-box-seam-fill"></i></div>
                        <h5 class="fw-bold mb-2">Kontrol Stok Otomatis</h5>
                        <p class="text-muted">Stok produk terpotong otomatis setiap transaksi. Notifikasi jika stok menipis (min stock alert).</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <h5 class="fw-bold mb-2">Laporan & Analisis Akurat</h5>
                        <p class="text-muted">Dashboard lengkap dengan laporan laba rugi, penjualan terlaris, dan riwayat transaksi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="bi bi-printer-fill"></i></div>
                        <h5 class="fw-bold mb-2">Cetak Struk & Kirim Digital</h5>
                        <p class="text-muted">Cetak struk dengan printer thermal atau kirim struk digital via WhatsApp/Email.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="bi bi-tags-fill"></i></div>
                        <h5 class="fw-bold mb-2">Manajemen Diskon & Promo</h5>
                        <p class="text-muted">Atur diskon per produk, per total belanja, atau buat kode voucher khusus pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                        <h5 class="fw-bold mb-2">Kelola Karyawan (Kasir)</h5>
                        <p class="text-muted">Tambahkan banyak kasir, atur hak akses, dan pantau performa penjualan setiap karyawan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo / Screenshot Section -->
    <section class="screenshot-section section-padding" id="screenshot">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Tampilan Aplikasi Kami</h2>
                <p class="section-subtitle">Lihat bagaimana antarmuka Kasirku yang bersih dan intuitif bekerja</p>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <img src="{{ asset('img/1.png') }}" alt="Dashboard Kasirku" class="screenshot-img">
                    <div class="small text-muted mt-2">Dashboard Analitik</div>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <img src="{{ asset('img/2.png') }}" alt="Transaksi Kasir" class="screenshot-img">
                    <div class="small text-muted mt-2">Halaman Kasir (POS)</div>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <img src="{{ asset('img/3.png') }}" alt="Laporan Penjualan" class="screenshot-img">
                    <div class="small text-muted mt-2">Laporan Stok & Produk</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section section-padding" id="pricing">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Pilih Paket Anda</h2>
                <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan dan skala bisnis Anda. Transparan, tanpa biaya tersembunyi.</p>
            </div>
            <div class="row justify-content-center">
                <!-- Paket Gratis -->
                <div class="col-lg-4 col-md-6">
                    <div class="price-card text-center">
                        <h5 class="price-title">Starter</h5>
                        <div class="price-value">Rp 0<span class="fs-6 fw-normal text-muted">/selamanya</span></div>
                        <ul class="price-features text-start">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>1 Cabang / 1 Kasir</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Transaksi penjualan dasar</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Laporan penjualan harian</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Stok produk terbatas (50 produk)</li>
                            <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Tidak ada diskon / promo</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Dukungan komunitas</li>
                        </ul>
                        <a href="{{ route('login') }}" class="btn btn-cta w-100 mt-auto">Mulai Gratis</a>
                    </div>
                </div>

                <!-- Paket Populer (Pro) -->
                <div class="col-lg-4 col-md-6">
                    <div class="price-card text-center featured">
                        <span class="badge bg-danger mb-3 py-2 px-3 fw-bold rounded-pill shadow-sm">Paling Populer</span>
                        <h5 class="price-title">Pro</h5>
                        <div class="price-value">Rp 99.000<span class="fs-6 fw-normal text-muted">/bulan</span></div>
                        <ul class="price-features text-start">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>5 Cabang / Kasir tak terbatas</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Semua fitur di Paket Starter</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Laporan lengkap (laba rugi, stok, dll)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Manajemen Diskon & Promo</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Stok produk tak terbatas</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Backup data otomatis harian</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Dukungan prioritas email & live chat</li>
                        </ul>
                        <a href="#" class="btn btn-cta w-100 mt-auto">Upgrade Sekarang</a>
                    </div>
                </div>

                <!-- Paket Enterprise -->
                <div class="col-lg-4 col-md-6">
                    <div class="price-card text-center">
                        <h5 class="price-title">Enterprise</h5>
                        <div class="price-value">Hubungi Kami</div>
                        <ul class="price-features text-start">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>20+ Cabang / Kasir tak terbatas</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Semua fitur di Paket Pro</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Laporan analitik mendalam & kustom</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pengelolaan multi-cabang terpusat</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Integrasi API/ERP kustom</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Custom branding & fitur</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Dukungan 24/7 & pelatihan on-site</li>
                        </ul>
                        <a href="#kontak" class="btn btn-outline-primary w-100 mt-auto">Hubungi Tim Sales</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section class="testimoni-section section-padding" id="testimoni">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Apa Kata Mereka</h2>
                <p class="section-subtitle">Ribuan UMKM sudah mempercayai Kasirku untuk mempercepat dan mempermudah operasional bisnis mereka.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card text-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="testi-photo" alt="Budi Santoso">
                        <div class="testi-name">Budi Santoso</div>
                        <div class="text-muted small mb-2">Pemilik Kedai Kopi "Kopi Pagi"</div>
                        <div class="testi-rating">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        </div>
                        <div class="testi-quote">"Aplikasi ini mengubah cara kami bekerja. Transaksi jauh lebih cepat, dan yang paling penting, stok bahan baku jadi mudah dikontrol!"</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card text-center">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="testi-photo" alt="Siti Rahmawati">
                        <div class="testi-name">Siti Rahmawati</div>
                        <div class="text-muted small mb-2">Manajer Toko "Baju Kekinian"</div>
                        <div class="testi-rating">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <div class="testi-quote">"Sangat *user friendly*, tim kasir baru bisa langsung menggunakannya. Fitur laporannya sangat detail, membantu analisis penjualan bulanan kami."</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card text-center">
                        <img src="https://randomuser.me/api/portraits/men/65.jpg" class="testi-photo" alt="Andi Wijaya">
                        <div class="testi-name">Andi Wijaya</div>
                        <div class="text-muted small mb-2">Pemilik Warung "Sembako Jaya"</div>
                        <div class="testi-rating">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <div class="testi-quote">"Cocok untuk UMKM seperti kami. Harga terjangkau, fitur lengkap, dan layanan pelanggannya sangat responsif saat kami ada kendala."</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section section-padding" id="faq">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Pertanyaan Umum (FAQ)</h2>
                <p class="section-subtitle">Jawaban cepat untuk pertanyaan yang sering diajukan oleh calon pengguna.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Apakah Kasirku harus selalu terhubung dengan internet?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Untuk sinkronisasi data, Kasirku membutuhkan koneksi internet. Namun, pada paket Pro dan Enterprise, kami menyediakan mode offline terbatas agar transaksi tetap bisa dilakukan saat koneksi terputus. Data akan disinkronkan otomatis saat terhubung kembali.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Jenis printer apa yang kompatibel dengan Kasirku?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Kasirku kompatibel dengan sebagian besar printer thermal (atau dot-matrix) yang terhubung melalui Bluetooth, USB, atau koneksi LAN, tergantung pada perangkat keras yang Anda gunakan (PC/tablet/smartphone).</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Bagaimana cara migrasi data produk dari sistem lama?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Anda dapat mengimpor data produk Anda secara massal menggunakan file Excel (.csv). Panduan lengkap tersedia di halaman Bantuan. Tim dukungan kami siap membantu proses migrasi data jika Anda mengambil paket Pro atau Enterprise.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Apakah ada biaya tambahan selain biaya bulanan?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Tidak ada. Biaya bulanan sudah mencakup akses ke semua fitur paket yang Anda pilih, *hosting* data, dan dukungan teknis. Kami tidak membebankan biaya per transaksi.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Akhir -->
    <section class="cta-section section-padding" id="cta">
        <div class="container">
            <h2 class="section-title">Siap Tingkatkan Bisnis Anda?</h2>
            <p class="section-subtitle">Jangan biarkan manajemen stok dan laporan menghabiskan waktu Anda. Coba Kasirku sekarang!</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-cta btn-lg">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-cta btn-lg">Coba Gratis 14 Hari</a>
                @endauth
                <a href="#kontak" class="btn btn-outline-primary btn-lg">Tanya Tim Kami</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4 text-md-start text-center mb-3 mb-md-0">
                    <span class="footer-logo">Kasir<span>ku</span></span>
                    <p class="small mt-2 text-muted-light">Aplikasi kasir modern berbasis cloud untuk UMKM.</p>
                </div>
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <a href="#home" class="footer-link">Home</a>
                    <a href="#features" class="footer-link">Fitur</a>
                    <a href="#pricing" class="footer-link">Harga</a>
                    <a href="#faq" class="footer-link">FAQ</a>
                    <a href="mailto:support@kasirku.com" class="footer-link">Email Kami</a>
                </div>
                <div class="col-md-4 text-md-end text-center footer-social">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div class="text-center small pt-3 border-top border-secondary">
                <p class="footer-bottom-text mb-0">&copy; {{ date('Y') }} Kasirku. All rights reserved. | <a href="#" class="footer-link">Terms of Service</a> | <a href="#" class="footer-link">Privacy Policy</a></p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
