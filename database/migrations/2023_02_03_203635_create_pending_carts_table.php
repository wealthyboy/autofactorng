<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_ids')->nullable();
            $table->string('coupon')->nullable();
            $table->integer('shipping_id')->nullable();
            $table->text('delivery_note')->nullable();
            $table->string('total')->nullable();
            $table->string('uuid')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_carts');
    }
}
