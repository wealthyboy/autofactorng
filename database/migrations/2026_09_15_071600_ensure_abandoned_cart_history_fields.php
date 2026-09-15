<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureAbandonedCartHistoryFields extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('abandoned_carts')) {
            return;
        }

        $missingCartToken = ! Schema::hasColumn('abandoned_carts', 'cart_token');
        $missingReminderSentAt = ! Schema::hasColumn('abandoned_carts', 'reminder_sent_at');
        $missingRecoveredAt = ! Schema::hasColumn('abandoned_carts', 'recovered_at');

        if ($missingCartToken || $missingReminderSentAt || $missingRecoveredAt) {
            Schema::table('abandoned_carts', function (Blueprint $table) use (
                $missingCartToken,
                $missingReminderSentAt,
                $missingRecoveredAt
            ) {
                if ($missingCartToken) {
                    $table->string('cart_token', 191)->nullable();
                }
                if ($missingReminderSentAt) {
                    $table->timestamp('reminder_sent_at')->nullable();
                }
                if ($missingRecoveredAt) {
                    $table->timestamp('recovered_at')->nullable();
                }
            });
        }
    }

    public function down()
    {
        // Preserve historical data. These columns are intentionally not dropped.
    }
}
