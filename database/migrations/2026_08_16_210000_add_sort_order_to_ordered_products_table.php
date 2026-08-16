<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortOrderToOrderedProductsTable extends Migration
{
    public function up()
    {
        Schema::table('ordered_products', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->nullable()->after('product_id');
        });
    }

    public function down()
    {
        Schema::table('ordered_products', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}
