# Naskah PPT — Implementasi Aplikasi Basis Data (maksimal 5 slide)

> Studi kasus: **RattanHandmade**, aplikasi penjualan produk kayu, rotan, dan sintetis. Isi berikut merujuk pada source code yang ada di repository proyek.

## Slide 1 — Gambaran Implementasi dan Struktur Proyek

### RattanHandmade — Implementasi Aplikasi Penjualan Berbasis Database

**Gambaran aplikasi**  
Aplikasi Laravel untuk menampilkan produk, mengelola keranjang, checkout, menyimpan transaksi, dan mengelola produk/pesanan melalui panel admin.

**Organisasi folder dan modul utama**

```text
app/
 ├─ Http/Controllers/     ProductController, CartController,
 │                         CheckoutController, OrderController
 └─ Models/               User, Admin, Category, Product, Cart,
                           Transaction, TransactionDetail
database/
 ├─ migrations/           pembuatan tabel, constraint, procedure
 └─ seeders/              data awal admin, customer, kategori, produk
resources/views/          halaman Blade customer dan admin
routes/web.php            route publik, customer, dan admin
tests/Feature/            pengujian alur autentikasi dan bisnis
README.md                 instalasi, fitur, dan dokumentasi proyek
```

**Organisasi sumber daya pemrograman**  
Route mengarahkan request ke controller. Controller memproses validasi dan logika bisnis, lalu menggunakan model Eloquent untuk membaca/menulis tabel MySQL. View Blade menyajikan hasil ke customer atau admin.

---

## Slide 2 — Library, API, dan Komponen Pendukung

| Komponen yang digunakan | Fungsi pada proyek |
|---|---|
| **PHP 8.1 + Laravel 10** | Framework backend: routing, controller, validasi request, migration, seeder, dan autentikasi. |
| **MySQL + PDO MySQL** | DBMS dan driver koneksi yang dikonfigurasi pada `config/database.php`. |
| **Eloquent ORM** | Model `Product`, `Cart`, `Transaction`, dan model lainnya mengakses tabel serta relasinya. |
| **DB Facade** | Menjalankan transaction checkout dan memanggil stored procedure status pesanan. |
| **Laravel Breeze** | Fitur autentikasi customer. |
| **Blade + Tailwind CSS + Vite + Alpine.js** | View dan aset antarmuka aplikasi. |
| **PHPUnit** | Pengujian feature, termasuk tambah keranjang, checkout, dan update status pesanan. |

**Komponen pre-existing/API**  
Proyek tidak menggunakan API pihak ketiga. Komponen yang dimanfaatkan berasal dari ekosistem Laravel, misalnya Eloquent ORM, middleware `auth`/`auth:admin`, Storage untuk gambar produk, dan `Str::random()` untuk membentuk `order_id`.

**Alasan pemakaian**  
Laravel menyatukan struktur MVC, migration, validasi, dan autentikasi. MySQL dipakai karena proyek menggunakan foreign key, constraint, database transaction, serta stored procedure MySQL.

---

## Slide 3 — Implementasi SQL dan Akses Basis Data

**Mekanisme koneksi dan teknik akses data**

- Konfigurasi database Laravel memakai koneksi default `mysql`; host, port, nama database, username, dan password diambil dari environment variable `DB_*` pada `.env` melalui `config/database.php`.
- Akses data utama menggunakan **Eloquent ORM**. Contoh Read produk beserta kategori (eager loading):

```php
$products = Product::with('category')->latest()->get();
```

**CRUD produk yang diimplementasikan pada `ProductController`**

```php
// Create                 // Update                  // Delete
Product::create($data);   $product->update($data);   $product->delete();
```

Data divalidasi sebelum disimpan: `category_id` harus ada pada tabel `categories`; `price` minimum 0; `stock` bilangan bulat minimum 0; gambar dibatasi format dan ukuran.

**SQL yang benar-benar ada/dijalankan**

```sql
-- Migration: mencegah item produk yang sama dua kali pada keranjang user
ALTER TABLE carts
ADD CONSTRAINT carts_user_id_product_id_unique UNIQUE (user_id, product_id);

-- Pemanggilan dari OrderController
CALL update_transaction_status(?, ?);
```

`CALL` dieksekusi dengan parameter binding melalui `DB::statement(...)`, sehingga ID transaksi dan status dikirim sebagai parameter, bukan digabung langsung ke string SQL.

---

## Slide 4 — Implementasi Algoritma dan Stored Procedure MySQL

> Proyek memakai **stored procedure MySQL**, bukan PL/SQL Oracle.

**Procedure `update_transaction_status`**

```sql
CREATE PROCEDURE update_transaction_status(
  IN p_transaction_id BIGINT UNSIGNED,
  IN p_status VARCHAR(50)
)
```

Logika procedure: memvalidasi bahwa status termasuk enam status yang diizinkan → memastikan transaksi tersedia → menjalankan `UPDATE transactions SET status = p_status, updated_at = NOW()`.

**Algoritma checkout pada `CheckoutController::process()`**

```text
ambil cart user → jika kosong, tampilkan error
→ begin transaction
→ untuk setiap cart: cek stock dan hitung total harga
→ buat transactions
→ untuk setiap cart: buat transaction_details dan kurangi stock
→ hapus carts user → commit
jika exception: rollback dan tampilkan error
```

**Mengapa menggunakan transaction?**  
Agar pembuatan transaksi, detail pembelian, pengurangan stok, dan penghapusan keranjang diperlakukan sebagai satu proses. Jika terjadi error, `DB::rollBack()` membatalkan perubahan pada blok tersebut.

---

## Slide 5 — Dokumentasi Kode Program

**Dokumentasi yang tersedia dalam proyek**

| Artefak | Isi dokumentasi/bukti implementasi |
|---|---|
| `README.md` | Fitur, teknologi, struktur database, relasi, prosedur status transaksi, alur checkout, instalasi, akun demo, dan perintah test. |
| `database/migrations` | Dokumentasi eksekusi struktur tabel, FK, unique constraint, serta stored procedure dalam bentuk kode migration. |
| `database/seeders` | Data awal admin, customer, kategori, produk, dan transaksi demo. |
| `tests/Feature/BusinessFlowTest.php` | Test tambah keranjang, pembatasan kuantitas melebihi stok, checkout, dan update status melalui procedure. |

**Praktik penulisan kode yang terlihat**

- Struktur MVC Laravel: model, controller, view, dan route dipisahkan berdasarkan tanggung jawabnya.
- Validasi request diterapkan sebelum operasi simpan atau ubah produk dan status pesanan.
- `Product::with('category')` dan `Cart::with('product')` digunakan untuk memuat relasi bersama data utama.
- `try/catch` dan database transaction diterapkan pada checkout; status order divalidasi melalui `Transaction::STATUSES` dan stored procedure.
- Data sensitif koneksi disimpan dalam `.env`; dokumentasi juga mengingatkan agar `.env` tidak masuk repository.

**Bukti yang dapat ditunjukkan saat asesmen:** jalankan migration dan seeder (`php artisan migrate`, `php artisan db:seed`), lalu test (`php artisan test`) sebagaimana didokumentasikan pada README.
