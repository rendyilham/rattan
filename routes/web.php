<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminAuthController; // Controller baru untuk Login Admin
use App\Models\Product;
use App\Models\Transaction; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $products = Product::with('category')->latest()->get();
    return view('welcome', compact('products'));
});


/*
|--------------------------------------------------------------------------
| RUTE CUSTOMER (Guard default 'web' bawaan Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Riwayat Pesanan Customer (Dashboard Pelanggan)
    Route::get('/dashboard', function () {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('transactions'));
    })->name('dashboard');

    // Pengaturan Akun Customer
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{transaction}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Memuat rute login/register bawaan Breeze untuk Customer
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| RUTE KHUSUS ADMIN (Guard khusus 'admin')
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Login Rahasia (Hanya bisa diakses jika belum login admin)
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Halaman Internal Admin (Proteksi ketat auth:admin)
    Route::middleware(['auth:admin'])->group(function () {
        
        // Dashboard Utama Admin (Tetap memanggil AdminController@index agar data statistik jalan)
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Modul Manajemen
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'update']);
        
        // Logout Admin
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});