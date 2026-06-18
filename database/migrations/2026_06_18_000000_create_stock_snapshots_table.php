<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSnapshotsTable extends Migration
{
    public function up()
    {
        Schema::create('stock_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id')->index();
            $table->string('source')->nullable();
            $table->unsignedBigInteger('product_id')->index();
            $table->string('product_name');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->unique(['batch_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_snapshots');
    }
}
