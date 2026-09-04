<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCustomerStatusAndPrivateBusinessOrders extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'customer_status')) {
                $table->string('customer_status')->default('private')->after('type')->index();
            }
        });

        if (Schema::hasColumn('users', 'customer_status')) {
            DB::table('users')
                ->where(function ($query) {
                    $query->whereNull('customer_status')->orWhere('customer_status', '');
                })
                ->update(['customer_status' => 'private']);
        }

        if (Schema::hasColumn('orders', 'category')) {
            DB::table('orders')
                ->where(function ($query) {
                    $query->whereNull('category')
                        ->orWhere('category', '')
                        ->orWhere('category', 'general');
                })
                ->update(['category' => 'private']);

            Schema::table('orders', function (Blueprint $table) {
                $table->string('category')->default('private')->change();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('orders', 'category')) {
            DB::table('orders')
                ->whereIn('category', ['private', 'business'])
                ->update(['category' => 'general']);

            Schema::table('orders', function (Blueprint $table) {
                $table->string('category')->default('general')->change();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'customer_status')) {
                $table->dropColumn('customer_status');
            }
        });
    }
}
