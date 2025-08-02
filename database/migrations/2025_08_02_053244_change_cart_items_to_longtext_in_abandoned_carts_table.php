<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCartItemsToLongtextInAbandonedCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abandoned_carts', function (Blueprint $table) {
            $table->longText('cart_items')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('longtext_in_abandoned_carts', function (Blueprint $table) {
            //
        });
    }
}
