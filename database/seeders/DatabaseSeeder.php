<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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

        Product::updateOrCreate(
            ['name' => 'Lemari Pajangan Mahoni'],
            [
                'category_id' => Category::where('name', 'Kayu')->value('id'),
                'price' => 2750000,
                'stock' => 6,
                'description' => 'Lemari pajangan berbahan kayu mahoni dengan ruang penyimpanan luas dan tampilan klasik.'
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Meja Kopi Rotan Bundar'],
            [
                'category_id' => Category::where('name', 'Rotan')->value('id'),
                'price' => 650000,
                'stock' => 12,
                'description' => 'Meja kopi bundar dengan anyaman rotan rapi, ringan, dan cocok untuk ruang tamu maupun teras.'
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Set Kursi Outdoor Sintetis'],
            [
                'category_id' => Category::where('name', 'Sintetis')->value('id'),
                'price' => 3200000,
                'stock' => 4,
                'description' => 'Set kursi outdoor berbahan rotan sintetis tahan cuaca dengan desain modern.'
            ]
        );

        // 5. Buat data pesanan demo untuk dashboard customer dan admin.
        $customer = User::where('email', 'customer@tokokayu.com')->first();

        $orders = [
            [
                'order_id' => 'ORD-DEMO01',
                'status' => 'Menunggu Pembayaran',
                'items' => [
                    ['product' => 'Meja Kopi Rotan Bundar', 'quantity' => 1],
                    ['product' => 'Kursi Santai Teras', 'quantity' => 2],
                ],
            ],
            [
                'order_id' => 'ORD-DEMO02',
                'status' => 'Diproses',
                'items' => [
                    ['product' => 'Meja Kerja Jati', 'quantity' => 1],
                ],
            ],
            [
                'order_id' => 'ORD-DEMO03',
                'status' => 'Selesai',
                'items' => [
                    ['product' => 'Lemari Pajangan Mahoni', 'quantity' => 1],
                    ['product' => 'Set Kursi Outdoor Sintetis', 'quantity' => 1],
                ],
            ],
        ];

        foreach ($orders as $orderData) {
            $totalPrice = 0;

            foreach ($orderData['items'] as $item) {
                $product = Product::where('name', $item['product'])->first();
                $totalPrice += $product->price * $item['quantity'];
            }

            $transaction = Transaction::updateOrCreate(
                ['order_id' => $orderData['order_id']],
                [
                    'user_id' => $customer->id,
                    'total_price' => $totalPrice,
                    'status' => $orderData['status'],
                ]
            );

            $transaction->details()->delete();

            foreach ($orderData['items'] as $item) {
                $product = Product::where('name', $item['product'])->first();

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }
        }
    }
}
