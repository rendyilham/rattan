<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Hitung total pendapatan (abaikan yang dibatalkan)
        $totalPendapatan = Transaction::where('status', '!=', 'Dibatalkan')->sum('total_price');
        
        // 2. Hitung total pesanan yang masuk
        $totalTransaksi = Transaction::count();
        
        // 3. Hitung sisa stok semua produk di etalase
        $totalStok = Product::sum('stock');
        
        // 4. Ambil 5 transaksi paling baru untuk tabel aktivitas
        $transaksiTerbaru = Transaction::latest()->take(5)->get();

        // Kirim semua data ke tampilan dashboard
        return view('admin.dashboard', compact(
            'totalPendapatan', 
            'totalTransaksi', 
            'totalStok', 
            'transaksiTerbaru'
        ));
    }
}