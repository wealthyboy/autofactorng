<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderedProductTableAddI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::rename('ordered_product', 'ordered_products');
        // Schema::table('ordered_products', function (Blueprint $table) {
        //     $table->renameColumn('item_name', 'product_name');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordered_product', function (Blueprint $table) {
            //
        });
    }
}
