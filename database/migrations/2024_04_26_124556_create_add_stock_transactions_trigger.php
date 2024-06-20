<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER add_stock_transaction
            AFTER DELETE ON transaction_details
            FOR EACH ROW
            BEGIN
                UPDATE products SET stock = stock + OLD.qty WHERE id = OLD.product_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS add_stock_transaction;');
    }
};
