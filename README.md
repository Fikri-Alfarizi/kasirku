
# Kasirku

Sistem aplikasi kasir berbasis web menggunakan Laravel. Aplikasi ini dirancang untuk membantu pengelolaan transaksi penjualan, produk, pelanggan, dan promo pada toko retail atau usaha kecil menengah.

## Fitur Utama

- **Manajemen Produk:** CRUD produk, stok, harga, deskripsi, dan gambar.
- **Manajemen Pelanggan:** CRUD data pelanggan.
- **Transaksi Penjualan:** Proses transaksi kasir, keranjang, diskon, dan promo.
- **Promo:** Pengelolaan promo diskon (persen/nominal) dengan periode aktif.
- **Laporan:** Laporan penjualan harian dan bulanan.
- **Dashboard:** Statistik penjualan, produk, dan pelanggan.
- **Autentikasi User:** Login kasir (fitur dasar, dapat dikembangkan).

## Struktur Folder

- `app/Models/` — Model Eloquent untuk Produk, Pelanggan, Penjualan, DetailPenjualan, Promo, User
- `app/Http/Controllers/` — Controller untuk dashboard, produk, pelanggan, penjualan, promo, laporan, landing, login
- `database/migrations/` — Migrasi tabel: users, produk, pelanggan, penjualan, detail_penjualan, promo
- `resources/views/` — Blade template untuk halaman admin, landing, laporan, pelanggan, penjualan, produk, promo, layouts
- `routes/web.php` — Routing utama aplikasi

## Instalasi

1. **Clone repository:**
	```bash
	git clone https://github.com/Fikri-Alfarizi/kasirku.git
	cd kasirku
	```
2. **Install dependency PHP & JS:**
	```bash
	composer install
	npm install
	```
3. **Copy file environment & generate key:**
	```bash
	cp .env.example .env
	php artisan key:generate
	```
4. **Migrasi database:**
	```bash
	php artisan migrate
	php artisan db:seed
	```
5. **Jalankan server lokal:**
	```bash
	php artisan serve
	npm run dev
	```

## Penggunaan

- Akses aplikasi di `http://localhost:8000`
- Login sebagai kasir (user default dapat dibuat di seeder atau register manual)
- Kelola produk, pelanggan, promo, dan lakukan transaksi penjualan

## Database

Tabel utama:

- **users** — Data user/kasir
- **produk** — Data produk
- **pelanggan** — Data pelanggan
- **penjualan** — Data transaksi penjualan
- **detail_penjualan** — Detail item pada transaksi
- **promo** — Data promo diskon

## Kontribusi

Pull request dan issue sangat terbuka untuk pengembangan lebih lanjut.

## Lisensi

MIT
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
