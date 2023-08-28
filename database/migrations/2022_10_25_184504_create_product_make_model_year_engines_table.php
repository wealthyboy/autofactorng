<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMakeModelYearEnginesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_make_model_year_engines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->index();
            $table->bigInteger('engine_id')->index();
            $table->bigInteger('attribute_id')->index();
            $table->bigInteger('category_id')->index();
            $table->string('year_from')->nullable()->index();
            $table->string('year_to')->nullable()->index();
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
        Schema::dropIfExists('product_make_model_year_engines');
    }
}
