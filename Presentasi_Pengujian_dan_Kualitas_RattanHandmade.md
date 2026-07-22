# Naskah PPT — Pengujian dan Peningkatan Kualitas Aplikasi (maksimal 5 slide)

> Studi kasus: **RattanHandmade**, aplikasi Laravel untuk katalog produk, keranjang, checkout, transaksi, dan panel admin. Semua poin di bawah diambil dari source code, `README.md`, riwayat Git lokal, serta file cache PHPUnit proyek.

## Slide 1 — Gambaran Umum Aplikasi dan Tools Pengujian

### RattanHandmade — Pengujian dan Evaluasi Kualitas Aplikasi Basis Data

**Deskripsi singkat**  
Customer dapat melihat produk, menambah item ke keranjang, dan checkout. Admin dapat login melalui guard `admin`, mengelola produk, melihat pesanan, serta memperbarui status pesanan dengan stored procedure MySQL.

| Area evaluasi | Tools/bukti yang digunakan pada proyek |
|---|---|
| Pengujian dan debugging | PHPUnit melalui `php artisan test`; test feature pada `tests/Feature/BusinessFlowTest.php`; pemeriksaan validasi dan controller. |
| Versioning | Git dan GitHub; repository lokal berada pada branch `main`. |
| Profiling | Pengukuran waktu eksekusi test dan pemeriksaan pola query/controller, sebagaimana didokumentasikan pada README. Tidak ditemukan profiler khusus seperti Xdebug atau Telescope pada repository. |
| Code review | Checklist review pada README dan pemeriksaan source code/migration/test. |

**Tujuan kegiatan:** menemukan masalah alur bisnis, memastikan integritas stok dan transaksi, mengurangi query relasi berulang, serta menjaga perubahan kode dapat dilacak.

---

## Slide 2 — Debugging

**Masalah dan perbaikan yang terdokumentasi**

| Masalah | Identifikasi dan perbaikan pada kode | Hasil |
|---|---|---|
| Jumlah produk di keranjang dapat melewati stok karena sebelumnya hanya memeriksa jumlah input baru. | `CartController` mengambil cart yang sudah ada, menghitung `$newQuantity = request quantity + cart quantity`, lalu membandingkannya dengan `product->stock`. | Penambahan item ditolak jika total jumlah di cart melebihi stok. |
| Status pesanan sebelumnya hanya divalidasi sebagai string. | `OrderController` menggunakan `Rule::in(Transaction::STATUSES)`; stored procedure juga menolak status di luar enam nilai yang diizinkan. | Status pesanan dibatasi ke daftar status resmi. |
| Data admin demo belum konsisten dengan guard admin. | `AdminSeeder` membuat akun pada tabel `admins`; autentikasi admin memakai guard `admin`. | Akun admin seed sesuai mekanisme login admin. |

**Tools/teknik yang digunakan:** feature test PHPUnit dengan `RefreshDatabase`, assertion seperti `assertDatabaseHas`/`assertDatabaseMissing`, validasi request Laravel, dan pengecekan exception pada proses checkout. Tidak ada penggunaan debugger visual yang didokumentasikan di repository.

---

## Slide 3 — Source Code Versioning

**Versioning yang digunakan:** Git dan GitHub; branch aktif yang terdeteksi adalah **`main`**.

**Contoh riwayat commit lokal**

```text
d70d1b4  last
c969c9a  rattan fix
d5ed999  add photo
b2abaaf  doc + test
27c8189  readme + procedure
```

Commit `b2abaaf` menambahkan dokumentasi dan `BusinessFlowTest`; commit `27c8189` menambahkan/memperbarui dokumentasi serta stored procedure status transaksi. README juga mendokumentasikan masalah credential GitHub di komputer lain: credential lama dihapus, kemudian login ulang dengan akun repository yang benar.

**Struktur branch dan kolaborasi**  
Repository yang tersedia hanya menunjukkan branch `main`. Pull request, merge, atau branch fitur tidak didokumentasikan, sehingga tidak diklaim sebagai proses yang dilakukan.

**Manfaat:** perubahan dapat dilacak melalui commit, fitur test/procedure dapat ditinjau berdasarkan perubahan file, dan `.gitignore` mencegah `.env`, `vendor`, serta `node_modules` ikut masuk repository.

---

## Slide 4 — Profiling Program

**Cara evaluasi performa yang didokumentasikan**

- Mengamati waktu eksekusi `php artisan test`.
- Meninjau jumlah dan pola query pada controller utama.
- Mengidentifikasi risiko *N+1 query* pada halaman produk dan keranjang.
- Memeriksa konsistensi checkout bila terjadi error.

**Hasil analisis dan optimasi yang diterapkan**

| Risiko/temuan | Optimasi yang ada pada kode |
|---|---|
| Relasi kategori dapat dipanggil berulang saat daftar produk ditampilkan. | `Product::with('category')->latest()->get()` memuat kategori bersama produk. |
| Relasi produk dapat dipanggil berulang saat keranjang ditampilkan. | `Cart::with('product')->where('user_id', Auth::id())->get()` memuat produk bersama cart. |
| Dashboard dapat memuat daftar transaksi terlalu banyak. | `Transaction::latest()->take(5)->get()` membatasi aktivitas terbaru menjadi lima data. |
| Perubahan data checkout dapat tidak konsisten ketika terjadi error. | `DB::beginTransaction()`, `DB::commit()`, dan `DB::rollBack()` digunakan pada `CheckoutController`. |
| Produk yang sama berpotensi tercatat dua kali dalam cart user. | Constraint `UNIQUE (user_id, product_id)` ditambahkan pada tabel `carts`. |

**Batasan bukti:** repository tidak menyimpan angka benchmark waktu, memori, atau hasil profiler khusus. Karena itu, presentasi tidak menyatakan angka performa yang tidak diukur.

---

## Slide 5 — Code Review dan Hasil Pengujian

**Metode dan temuan review**  
README mendokumentasikan fokus review: file sensitif tidak masuk repository, relasi memiliki FK/constraint, input divalidasi sebelum simpan, checkout menggunakan rollback, dan instalasi/akun demo terdokumentasi. Pemeriksaan kode menunjukkan penerapannya, misalnya:

```php
$request->validate([
    'category_id' => 'required|exists:categories,id',
    'price'       => 'required|numeric|min:0',
    'stock'       => 'required|integer|min:0',
]);
```

**Perbaikan hasil review:** validasi kuantitas cart, pembatasan status transaksi, constraint unik cart, eager loading, database transaction checkout, serta pemisahan seeder/guard admin.

**Hasil pengujian yang tersedia**

- `BusinessFlowTest` menguji: tambah cart, penolakan jumlah di atas stok, checkout membuat transaksi/detail dan mengurangi stok, serta pembaruan status admin melalui procedure.
- Test autentikasi dan profil customer juga tersedia di `tests/Feature/Auth` dan `ProfileTest.php`.
- File `.phpunit.result.cache` yang ada mencatat **29 test**, `defects: []` (tidak ada defect yang tercatat pada hasil test terakhir yang disimpan).

**Penutup untuk asesor:** sebelum demo, jalankan kembali `php artisan test`, kemudian jalankan aplikasi dan demonstrasikan tambah cart → checkout → perubahan stok → update status pesanan oleh admin.
