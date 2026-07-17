<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_add_product_to_cart(): void
    {
        $user = User::factory()->create();
        $product = $this->createProduct(stock: 5);

        $response = $this->actingAs($user)->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_customer_cannot_add_cart_quantity_above_stock(): void
    {
        $user = User::factory()->create();
        $product = $this->createProduct(stock: 3);

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($user)->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_checkout_creates_transaction_details_and_reduces_stock(): void
    {
        $user = User::factory()->create();
        $product = $this->createProduct(price: 150000, stock: 5);

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($user)->post('/checkout');

        $transaction = Transaction::first();

        $response->assertRedirect(route('checkout.success', $transaction->id));
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'total_price' => 300000,
            'status' => 'Menunggu Pembayaran',
        ]);
        $this->assertDatabaseHas('transaction_details', [
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'subtotal' => 300000,
        ]);
        $this->assertDatabaseMissing('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $this->assertSame(3, $product->fresh()->stock);
    }

    public function test_admin_can_update_order_status_using_database_procedure(): void
    {
        $admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
        $user = User::factory()->create();
        $transaction = Transaction::create([
            'order_id' => 'ORD-TEST01',
            'user_id' => $user->id,
            'total_price' => 250000,
            'status' => 'Menunggu Pembayaran',
        ]);

        $response = $this->actingAs($admin, 'admin')->put(route('admin.orders.update', $transaction->id), [
            'status' => 'Diproses',
        ]);

        $response->assertRedirect(route('admin.orders.index'));
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => 'Diproses',
        ]);
    }

    private function createProduct(int $price = 100000, int $stock = 10): Product
    {
        $category = Category::create(['name' => 'Rotan']);

        return Product::create([
            'category_id' => $category->id,
            'name' => 'Kursi Rotan',
            'price' => $price,
            'stock' => $stock,
            'description' => 'Produk untuk pengujian.',
        ]);
    }
}
