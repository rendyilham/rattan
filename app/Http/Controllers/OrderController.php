<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan pelanggan di panel admin.
     */
    public function index()
    {
        // Tarik semua data transaksi dari database, urutkan dari yang terbaru
        $orders = Transaction::latest()->get();

        // Kirimkan data transaksi dengan variabel bernama $orders ke view
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Memperbarui status transaksi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', Rule::in(Transaction::STATUSES)],
        ]);

        $order = Transaction::findOrFail($id);

        DB::statement('CALL update_transaction_status(?, ?)', [
            $order->id,
            $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan #' . $order->order_id . ' berhasil diperbarui!');
    }
}
