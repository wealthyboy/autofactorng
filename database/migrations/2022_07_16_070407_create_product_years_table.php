<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_years', function (Blueprint $table) {
            $table->id();
            $table->string('year_from')->nullable();
            $table->string('year_to')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('attribute_id')->nullable();
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
        Schema::dropIfExists('product_years');
    }
}
