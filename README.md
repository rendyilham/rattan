# RattanHandmade

RattanHandmade adalah aplikasi basis data penjualan produk kayu, rotan, dan sintetis berbasis Laravel. Aplikasi ini digunakan untuk mengelola katalog produk, keranjang belanja, checkout, transaksi pelanggan, serta pemantauan pesanan oleh admin.

## Fitur Utama

- Autentikasi customer dengan Laravel Breeze.
- Autentikasi admin menggunakan guard khusus `admin`.
- CRUD produk oleh admin.
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

Jalankan migration dan seeder ulang jika ada perubahan database:

```bash
php artisan migrate
php artisan db:seed
```
