<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE products MODIFY stock INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE carts MODIFY quantity INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE transaction_details MODIFY quantity INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE carts ADD CONSTRAINT carts_user_id_product_id_unique UNIQUE (user_id, product_id)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE carts DROP INDEX carts_user_id_product_id_unique');
        DB::statement('ALTER TABLE transaction_details MODIFY quantity INT NOT NULL');
        DB::statement('ALTER TABLE carts MODIFY quantity INT NOT NULL');
        DB::statement('ALTER TABLE products MODIFY stock INT NOT NULL');
    }
};
