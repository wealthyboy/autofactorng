<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('code')->unique();
            $table->string('amount');
            $table->integer('from_value')->length(11)->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('valid')->default(true);
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->timestamp('expires')->nullable(); 
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
        Schema::dropIfExists('vouchers');
    }
}
