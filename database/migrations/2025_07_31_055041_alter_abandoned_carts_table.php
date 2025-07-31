<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAbandonedCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abandoned_carts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable();
            $table->json('cart_items'); // store product IDs, quantities
            $table->timestamp('checkout_started_at');
            $table->boolean('recovered')->default(false); // If user completes order
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abandoned_carts', function (Blueprint $table) {
            //
        });
    }
}
