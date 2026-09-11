<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImproveAbandonedCartTracking extends Migration
{
    public function up()
    {
        Schema::table('abandoned_carts', function (Blueprint $table) {
            if (! Schema::hasColumn('abandoned_carts', 'cart_token')) {
                $table->string('cart_token', 191)->nullable()->after('user_id');
            }
            if (! Schema::hasColumn('abandoned_carts', 'reminder_sent_at')) {
                $table->timestamp('reminder_sent_at')->nullable()->after('recovered');
            }
            if (! Schema::hasColumn('abandoned_carts', 'recovered_at')) {
                $table->timestamp('recovered_at')->nullable()->after('reminder_sent_at');
            }
        });

        // Preserve a sensible recovery timestamp for any legacy rows that
        // were already marked recovered before this migration existed.
        DB::table('abandoned_carts')
            ->where('recovered', true)
            ->whereNull('recovered_at')
            ->update(['recovered_at' => DB::raw('updated_at')]);

        Schema::table('abandoned_carts', function (Blueprint $table) {
            if (! $this->indexExists('abandoned_carts', 'abandoned_carts_checkout_recovered_idx')) {
                $table->index(['checkout_started_at', 'recovered'], 'abandoned_carts_checkout_recovered_idx');
            }
            if (! $this->indexExists('abandoned_carts', 'abandoned_carts_user_recovered_idx')) {
                $table->index(['user_id', 'recovered'], 'abandoned_carts_user_recovered_idx');
            }
            if (! $this->indexExists('abandoned_carts', 'abandoned_carts_cart_token_idx')) {
                $table->index('cart_token', 'abandoned_carts_cart_token_idx');
            }
        });
    }

    public function down()
    {
        Schema::table('abandoned_carts', function (Blueprint $table) {
            foreach ([
                'abandoned_carts_checkout_recovered_idx',
                'abandoned_carts_user_recovered_idx',
                'abandoned_carts_cart_token_idx',
            ] as $index) {
                if ($this->indexExists('abandoned_carts', $index)) {
                    $table->dropIndex($index);
                }
            }

            foreach (['recovered_at', 'reminder_sent_at', 'cart_token'] as $column) {
                if (Schema::hasColumn('abandoned_carts', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    private function indexExists(string $table, string $index): bool
    {
        return ! empty(Schema::getConnection()->select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$index]));
    }
}
