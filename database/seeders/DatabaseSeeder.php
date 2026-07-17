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
        // 1. Buat akun admin khusus untuk guard admin.
        $this->call(AdminSeeder::class);

        // 2. Buat Akun Customer
        User::updateOrCreate(
            ['email' => 'customer@tokokayu.com'],
            [
                'name' => 'Pelanggan Setia',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );

        // 3. Buat Kategori Produk
        $categories = ['Kayu', 'Rotan', 'Sintetis'];
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }

        // 4. Buat Produk Dummy
        Product::updateOrCreate(
            ['name' => 'Meja Kerja Jati'],
            [
                'category_id' => Category::where('name', 'Kayu')->value('id'),
                'price' => 1500000,
                'stock' => 10,
                'description' => 'Meja kerja elegan dari kayu jati solid dengan finishing natural.'
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Kursi Santai Teras'],
            [
                'category_id' => Category::where('name', 'Rotan')->value('id'),
                'price' => 850000,
                'stock' => 15,
                'description' => 'Kursi santai estetik dengan anyaman rotan asli, cocok untuk teras rumah.'
            ]
        );
    }
}
