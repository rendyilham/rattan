# RattanHandmade

RattanHandmade adalah aplikasi basis data penjualan produk kayu, rotan, dan sintetis berbasis Laravel. Aplikasi ini digunakan untuk mengelola katalog produk, keranjang belanja, checkout, transaksi pelanggan, serta pemantauan pesanan oleh admin.

## Fitur Utama

- Autentikasi customer dengan Laravel Breeze.
- Autentikasi admin menggunakan guard khusus `admin`.
- CRUD produk oleh admin.
- Upload dan tampilan gambar produk.
- Kategori produk.
- Keranjang belanja per customer.
- Checkout dengan validasi stok dan database transaction.
- Pembuatan transaksi dan detail transaksi.
- Pengurangan stok setelah checkout.
- Update status pesanan oleh admin melalui stored procedure MySQL.
- Seeder data awal untuk admin, customer, kategori, dan produk demo.

## Struktur Project

- `routes/web.php`: definisi route publik, customer, dan admin.
- `app/Models`: representasi entitas database seperti `Product`, `Category`, `Cart`, `Transaction`, dan `TransactionDetail`.
- `app/Http/Controllers`: modul proses bisnis aplikasi.
- `database/migrations`: struktur tabel, constraint, dan stored procedure.
- `database/seeders`: data awal untuk kebutuhan demo dan pengujian.
- `resources/views`: tampilan Blade untuk customer dan admin.
- `config/auth.php`: konfigurasi guard customer dan admin.

## Teknologi

- PHP 8.1
- Laravel 10
- MySQL
- Eloquent ORM
- Laravel Migration dan Seeder
- Blade Template
- Tailwind CSS
- Vite

## Struktur Database Utama

- `users`: data customer.
- `admins`: data pengelola aplikasi.
- `categories`: kategori produk.
- `products`: data produk dan stok.
- `products.image_path`: lokasi file gambar produk pada storage publik.
- `carts`: keranjang belanja customer.
- `transactions`: data transaksi utama.
- `transaction_details`: detail produk dalam transaksi.

Relasi utama:

- `categories` 1 ke banyak `products`.
- `users` 1 ke banyak `carts`.
- `products` 1 ke banyak `carts`.
- `users` 1 ke banyak `transactions`.
- `transactions` 1 ke banyak `transaction_details`.
- `products` 1 ke banyak `transaction_details`.

## Implementasi Database Programming

Update status transaksi menggunakan stored procedure MySQL `update_transaction_status`.

Procedure ini bertugas:

- menerima ID transaksi dan status baru;
- memvalidasi status agar sesuai daftar status yang diperbolehkan;
- memastikan transaksi tersedia;
- memperbarui status dan waktu perubahan transaksi.

Controller admin memanggil procedure tersebut melalui:

```php
DB::statement('CALL update_transaction_status(?, ?)', [
    $order->id,
    $request->status,
]);
```

## Algoritma Checkout

Alur checkout berada di `CheckoutController`:

1. Mengambil seluruh data keranjang customer yang sedang login.
2. Mengecek apakah keranjang kosong.
3. Memulai database transaction.
4. Mengecek ketersediaan stok setiap produk.
5. Menghitung total harga.
6. Membuat data transaksi.
7. Membuat detail transaksi untuk setiap item.
8. Mengurangi stok produk.
9. Menghapus data keranjang.
10. Commit jika berhasil atau rollback jika terjadi error.

## Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
```

Jalankan aplikasi:

```bash
php artisan serve
```

## Akun Demo

Admin:

```text
Email: admin@kayukraft.com
Password: password123
URL: /admin/login
```

Customer:

```text
Email: customer@tokokayu.com
Password: password123
URL: /login
```

## Verifikasi

Jalankan test:

```bash
php artisan test
```

Pengujian yang digunakan:

- Unit test dasar untuk memastikan environment testing berjalan.
- Feature test autentikasi customer.
- Feature test profile customer.
- Feature test proses bisnis:
  - customer menambahkan produk ke keranjang;
  - validasi quantity keranjang agar tidak melebihi stok;
  - checkout membuat transaksi, detail transaksi, mengurangi stok, dan menghapus keranjang;
  - admin memperbarui status pesanan melalui stored procedure MySQL.

Jalankan migration dan seeder ulang jika ada perubahan database:

```bash
php artisan migrate
php artisan db:seed
```

Jika fitur gambar produk belum tampil setelah clone di perangkat baru, jalankan:

```bash
php artisan storage:link
```

## Debugging dan Evaluasi Kualitas

Beberapa masalah yang ditemukan selama pengembangan:

- Credential GitHub pada komputer berbeda masih memakai akun lama sehingga push ditolak. Solusi: menghapus credential GitHub lama dan login ulang dengan akun repository yang benar.
- Quantity keranjang sebelumnya hanya mengecek quantity baru, belum menghitung quantity yang sudah ada di keranjang. Solusi: menghitung total quantity baru sebelum menyimpan.
- Status transaksi sebelumnya hanya divalidasi sebagai string. Solusi: validasi status dibatasi sesuai daftar status resmi pada model `Transaction`.
- Seeder admin sebelumnya belum konsisten dengan guard admin. Solusi: admin demo dibuat melalui tabel `admins` dan `AdminSeeder`.

## Profiling dan Optimasi

Parameter yang dievaluasi:

- Waktu eksekusi test menggunakan `php artisan test`.
- Jumlah dan pola query pada controller utama.
- Risiko N+1 query pada halaman produk dan keranjang.
- Konsistensi proses checkout ketika terjadi error.

Optimasi yang diterapkan:

- Menggunakan eager loading `Product::with('category')` saat menampilkan produk agar relasi kategori tidak dipanggil berulang.
- Menggunakan `Cart::with('product')` pada halaman keranjang agar data produk dimuat bersama item keranjang.
- Membatasi data aktivitas dashboard admin dengan `take(5)`.
- Menggunakan database transaction pada checkout agar perubahan transaksi, detail transaksi, stok, dan keranjang tetap atomik.
- Menambahkan unique constraint pada `carts(user_id, product_id)` untuk mencegah duplikasi item keranjang.

## Versioning dan Code Review

Project dikelola menggunakan Git dan GitHub dengan branch utama `main`.

Contoh riwayat perubahan:

- `Initial commit`: inisialisasi project Laravel.
- `update admin user`: penyesuaian akun dan akses admin.
- `readme + procedure`: dokumentasi project dan stored procedure transaksi.

Fokus code review:

- memastikan file sensitif seperti `.env`, `vendor`, dan `node_modules` tidak masuk repository;
- memastikan relasi database memiliki foreign key dan constraint;
- memastikan input divalidasi sebelum disimpan;
- memastikan proses checkout memakai rollback ketika terjadi error;
- memastikan dokumentasi instalasi dan akun demo tersedia di README.
