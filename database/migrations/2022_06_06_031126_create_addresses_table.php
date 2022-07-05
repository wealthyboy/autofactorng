<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->integer('user_id')->unsigned();
			$table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
			$table->string('address');
			$table->string('address_2')->nullable();
			$table->string('city');
			$table->integer('state_id')->nullable();
            $table->integer('state')->nullable();
		    $table->string('postcode')->nullable();
			$table->string('country')->nullable();
			$table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('addresses');
    }
}
