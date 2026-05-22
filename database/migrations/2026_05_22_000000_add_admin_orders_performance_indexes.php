<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminOrdersPerformanceIndexes extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! $this->indexExists('orders', 'orders_created_at_index')) {
                $table->index('created_at', 'orders_created_at_index');
            }

            if (! $this->indexExists('orders', 'orders_user_id_index')) {
                $table->index('user_id', 'orders_user_id_index');
            }

            if (! $this->indexExists('orders', 'orders_email_index')) {
                $table->index('email', 'orders_email_index');
            }
        });

        Schema::table('ordered_products', function (Blueprint $table) {
            if (! $this->indexExists('ordered_products', 'ordered_products_order_id_index')) {
                $table->index('order_id', 'ordered_products_order_id_index');
            }
        });

        Schema::table('order_emails', function (Blueprint $table) {
            if (! $this->indexExists('order_emails', 'order_emails_order_id_index')) {
                $table->index('order_id', 'order_emails_order_id_index');
            }
        });
    }

    public function down()
    {
        Schema::table('order_emails', function (Blueprint $table) {
            if ($this->indexExists('order_emails', 'order_emails_order_id_index')) {
                $table->dropIndex('order_emails_order_id_index');
            }
        });

        Schema::table('ordered_products', function (Blueprint $table) {
            if ($this->indexExists('ordered_products', 'ordered_products_order_id_index')) {
                $table->dropIndex('ordered_products_order_id_index');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if ($this->indexExists('orders', 'orders_email_index')) {
                $table->dropIndex('orders_email_index');
            }

            if ($this->indexExists('orders', 'orders_user_id_index')) {
                $table->dropIndex('orders_user_id_index');
            }

            if ($this->indexExists('orders', 'orders_created_at_index')) {
                $table->dropIndex('orders_created_at_index');
            }
        });
    }

    protected function indexExists(string $table, string $index): bool
    {
        return ! empty(Schema::getConnection()->select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$index]));
    }
}
