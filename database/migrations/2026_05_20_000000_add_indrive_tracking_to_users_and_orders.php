<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndriveTrackingToUsersAndOrders extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'is_indrive_customer')) {
                $table->boolean('is_indrive_customer')->default(false)->after('type');
            }

            if (! Schema::hasColumn('users', 'acquisition_source')) {
                $table->string('acquisition_source')->nullable()->after('is_indrive_customer');
            }

            if (! Schema::hasColumn('users', 'acquisition_source_at')) {
                $table->timestamp('acquisition_source_at')->nullable()->after('acquisition_source');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'is_indrive_order')) {
                $table->boolean('is_indrive_order')->default(false)->after('order_from');
            }

            if (! Schema::hasColumn('orders', 'source_channel')) {
                $table->string('source_channel')->nullable()->after('is_indrive_order');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'source_channel')) {
                $table->dropColumn('source_channel');
            }

            if (Schema::hasColumn('orders', 'is_indrive_order')) {
                $table->dropColumn('is_indrive_order');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'acquisition_source_at')) {
                $table->dropColumn('acquisition_source_at');
            }

            if (Schema::hasColumn('users', 'acquisition_source')) {
                $table->dropColumn('acquisition_source');
            }

            if (Schema::hasColumn('users', 'is_indrive_customer')) {
                $table->dropColumn('is_indrive_customer');
            }
        });
    }
}
