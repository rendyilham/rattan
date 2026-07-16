<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Menampilkan isi keranjang pelanggan
    public function index()
    {
        // Ambil data keranjang khusus untuk user yang sedang login
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('carts'));
    }

    // 2. Memasukkan produk ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek apakah stok cukup sebelum masuk keranjang
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Maaf, stok ' . $product->name . ' tidak mencukupi.');
        }

        // Cek apakah barang sudah ada di keranjang user ini
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            // Jika barang sudah ada, cukup tambahkan kuantitasnya
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity
            ]);
        } else {
            // Jika belum ada, buat entri keranjang baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // 3. Menghapus barang dari keranjang
    public function destroy(Cart $cart)
    {
        // Pastikan user hanya bisa menghapus keranjangnya sendiri demi keamanan
        if ($cart->user_id == Auth::id()) {
            $cart->delete();
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}