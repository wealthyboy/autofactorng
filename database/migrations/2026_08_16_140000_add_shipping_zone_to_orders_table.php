<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShippingZoneToOrdersTable extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('orders', 'zone')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('zone')->nullable()->after('shipping_price');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('orders', 'zone')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('zone');
            });
        }
    }
}
