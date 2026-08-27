<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCuratedOrderingToCategoriesAndProducts extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedSmallInteger('curated_page_size')->nullable()->after('sort_order');
        });

        Schema::table('category_product', function (Blueprint $table) {
            $table->unsignedSmallInteger('curated_position')->nullable()->after('product_id');
            $table->index(['category_id', 'curated_position'], 'category_product_curated_order_index');
        });
    }

    public function down()
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->dropIndex('category_product_curated_order_index');
            $table->dropColumn('curated_position');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('curated_page_size');
        });
    }
}
