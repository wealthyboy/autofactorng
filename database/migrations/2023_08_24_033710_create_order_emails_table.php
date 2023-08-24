<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_emails', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment')->nullable();
            $table->string('landmark')->nullable();
            $table->string('address')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('shipping')->nullable();
            $table->integer('state_id')->nullable();
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
        Schema::dropIfExists('order_emails');
    }
}
