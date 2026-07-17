<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS update_transaction_status');

        DB::unprepared("
            CREATE PROCEDURE update_transaction_status(
                IN p_transaction_id BIGINT UNSIGNED,
                IN p_status VARCHAR(50)
            )
            BEGIN
                IF p_status NOT IN (
                    'Menunggu Pembayaran',
                    'Pembayaran Dikonfirmasi',
                    'Diproses',
                    'Dikirim',
                    'Selesai',
                    'Dibatalkan'
                ) THEN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Status transaksi tidak valid';
                END IF;

                IF NOT EXISTS (
                    SELECT 1
                    FROM transactions
                    WHERE id = p_transaction_id
                ) THEN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Transaksi tidak ditemukan';
                END IF;

                UPDATE transactions
                SET status = p_status,
                    updated_at = NOW()
                WHERE id = p_transaction_id;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS update_transaction_status');
    }
};
