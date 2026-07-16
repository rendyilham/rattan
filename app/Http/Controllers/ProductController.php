<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk (Read)
    public function index() {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan halaman form tambah produk (Create)
    public function create() {
        // Ambil semua kategori (Kayu, Rotan, Sintetis) buat dimunculin di dropdown form
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Memproses data dari form dan menyimpannya ke database
    public function store(Request $request) {
        // Validasi dulu biar admin nggak ngasal masukin data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        // Simpan ke MySQL
        Product::create($request->all());

        // Balikin ke halaman daftar produk bawa pesan sukses
        return redirect()->route('admin.products.index')->with('success', 'Asyik, produk baru berhasil ditambahkan ke etalase!');
    }

    // Menampilkan halaman form edit produk beserta data lamanya
    public function edit(Product $product) {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Memproses pembaruan data ke database
    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Sip, data produk berhasil diperbarui!');
    }

    // Menghapus produk (Delete)
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus dari etalase!');
    }
}