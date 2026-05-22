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

            if (! $this->indexExists('orders', 'orders_indrive_report_index')) {
                $table->index(['is_indrive_order', 'user_id', 'created_at'], 'orders_indrive_report_index');
            }

            if (! $this->indexExists('orders', 'orders_indrive_status_index')) {
                $table->index(['is_indrive_order', 'status', 'created_at'], 'orders_indrive_status_index');
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

        Schema::table('user_trackings', function (Blueprint $table) {
            if (! $this->indexExists('user_trackings', 'user_trackings_indrive_user_visit_index')) {
                $table->index(['is_indrive', 'user_id', 'visited_at'], 'user_trackings_indrive_user_visit_index');
            }

            if (! $this->indexExists('user_trackings', 'user_trackings_indrive_driver_visit_index')) {
                $table->index(['is_indrive', 'indrive_driver_id', 'visited_at'], 'user_trackings_indrive_driver_visit_index');
            }

            if (! $this->indexExists('user_trackings', 'user_trackings_indrive_session_visit_index')) {
                $table->index(['is_indrive', 'session_id', 'visited_at'], 'user_trackings_indrive_session_visit_index');
            }
        });
    }

    public function down()
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            if ($this->indexExists('user_trackings', 'user_trackings_indrive_session_visit_index')) {
                $table->dropIndex('user_trackings_indrive_session_visit_index');
            }

            if ($this->indexExists('user_trackings', 'user_trackings_indrive_driver_visit_index')) {
                $table->dropIndex('user_trackings_indrive_driver_visit_index');
            }

            if ($this->indexExists('user_trackings', 'user_trackings_indrive_user_visit_index')) {
                $table->dropIndex('user_trackings_indrive_user_visit_index');
            }
        });

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
            if ($this->indexExists('orders', 'orders_indrive_status_index')) {
                $table->dropIndex('orders_indrive_status_index');
            }

            if ($this->indexExists('orders', 'orders_indrive_report_index')) {
                $table->dropIndex('orders_indrive_report_index');
            }

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
