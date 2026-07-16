<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tokokayu.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Customer
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'customer@tokokayu.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        // 3. Buat Kategori Produk
        $categories = ['Kayu', 'Rotan', 'Sintetis'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // 4. Buat Produk Dummy
        Product::create([
            'category_id' => 1, // 1 = Kayu
            'name' => 'Meja Kerja Jati',
            'price' => 1500000,
            'stock' => 10,
            'description' => 'Meja kerja elegan dari kayu jati solid dengan finishing natural.'
        ]);

        Product::create([
            'category_id' => 2, // 2 = Rotan
            'name' => 'Kursi Santai Teras',
            'price' => 850000,
            'stock' => 15,
            'description' => 'Kursi santai estetik dengan anyaman rotan asli, cocok untuk teras rumah.'
        ]);
    }
}