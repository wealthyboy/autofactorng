<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->biginteger('price');
            $table->integer('brand_id')->nullable();
            $table->integer('make')->nullable();
            $table->string('model')->nullable();
            $table->string('generic_name')->nullable();
            $table->string('rim_size')->nullable();
            $table->string('radius')->nullable();
            $table->bigInteger('year')->nullable();
            $table->bigInteger('year_from')->nullable();
            $table->bigInteger('year_to')->nullable();
            $table->string('keywords')->nullable();
            $table->string('title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('engine')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->text('description')->nullable();
            $table->decimal('total')->nullable();
            $table->integer('sale_price')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('quantity');
            $table->boolean('allow')->default(true);
            $table->boolean('featured')->default(false);
            $table->boolean('has_variants')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
