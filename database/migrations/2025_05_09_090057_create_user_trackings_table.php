<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('session_id')->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('coupon')->nullable();
            $table->decimal('original_amount', 15, 2)->nullable();
            $table->string('country')->nullable();
            $table->string('referer')->nullable();
            $table->string('user_agent')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('page_url')->nullable();
            $table->string('method')->nullable();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('action')->nullable(); //viewed, clicked, started_checkout, abandoned, etc.
            $table->integer('time_spent')->nullable(); // in seconds
            $table->string('ip_address')->nullable();
            $table->timestamp('visited_at')->nullable();
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
        Schema::dropIfExists('user_trackings');
    }
}
