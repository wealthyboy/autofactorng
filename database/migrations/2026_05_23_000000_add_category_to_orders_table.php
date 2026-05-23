<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCategoryToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'category')) {
                $table->string('category')->default('general')->after('order_from')->index();
            }
        });

        if (Schema::hasColumn('orders', 'category') && Schema::hasColumn('orders', 'is_indrive_order')) {
            DB::table('orders')
                ->where('is_indrive_order', true)
                ->update(['category' => 'indrive']);
        }
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
}
