<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Ambil semua isi keranjang user yang sedang login
        $carts = Cart::where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        try {
            DB::beginTransaction();

            $totalPrice = 0;
            
            // Hitung total harga dan cek stok
            foreach ($carts as $cart) {
                if ($cart->product->stock < $cart->quantity) {
                    throw new \Exception('Maaf, stok produk ' . $cart->product->name . ' tidak mencukupi.');
                }
                $totalPrice += $cart->product->price * $cart->quantity;
            }

            // Buat data transaksi utama
            $transaction = Transaction::create([
                'order_id' => 'ORD-' . strtoupper(Str::random(6)), // Menghasilkan resi seperti ORD-A1B2C3
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'Menunggu Pembayaran',
            ]);

            // Pindahkan data dari keranjang ke detail transaksi, lalu kurangi stok
            foreach ($carts as $cart) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->product->price * $cart->quantity,
                ]);

                $cart->product->update([
                    'stock' => $cart->product->stock - $cart->quantity
                ]);
            }

            // Hapus isi keranjang setelah sukses dipindahkan
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // Arahkan ke halaman sukses dengan membawa ID transaksi
            return redirect()->route('checkout.success', $transaction->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Menampilkan halaman sukses konfirmasi WhatsApp
    public function success(Transaction $transaction)
    {
        // Keamanan: Pastikan hanya pemilik transaksi yang bisa melihat halaman ini
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('transaction'));
    }
}