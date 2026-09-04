<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicProductFilterTables extends Migration
{
    public function up()
    {
        Schema::create('product_filter_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unique(['category_id', 'slug']);
        });

        Schema::create('product_filter_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_filter_group_id');
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('product_filter_group_id')->references('id')->on('product_filter_groups')->onDelete('cascade');
            $table->unique(['product_filter_group_id', 'slug']);
        });

        Schema::create('product_filter_option_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_filter_option_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_filter_option_id')->references('id')->on('product_filter_options')->onDelete('cascade');
            $table->unique(['product_id', 'product_filter_option_id'], 'product_filter_option_product_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_filter_option_product');
        Schema::dropIfExists('product_filter_options');
        Schema::dropIfExists('product_filter_groups');
    }
}
