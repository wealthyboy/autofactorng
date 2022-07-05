<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('sort_order')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('keywords')->nullable();
            $table->string('title')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('text_color')->nullable();
            $table->string('image_custom_link')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('parent_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('categories');
    }
}
