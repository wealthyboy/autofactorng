<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
			$table->integer('address_id')->nullable();
            $table->integer('first_name')->nullable();
			$table->integer('last_name')->nullable();
			$table->integer('city')->nullable();
			$table->integer('state')->nullable();
            $table->integer('landmark')->nullable();
            $table->integer('country')->nullable();
			$table->string('invoice')->nullable();
			$table->string('comment')->nullable();
			$table->string('tracking')->nullable();
			$table->string('payment_type')->nullable();
			$table->string('status')->nullable();
			$table->string('transaction_id')->nullable();
			$table->integer('currency_id')->length(10)->nullable();
            $table->string('shipping_price')->nullable();
			$table->string('total')->nullable();
			$table->string('coupon')->unique()->nullable();
			$table->string('order_type')->nullable();
			$table->string('order_from')->nullable();
			$table->string('ip')->nullable();
			$table->string('user_agent')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
