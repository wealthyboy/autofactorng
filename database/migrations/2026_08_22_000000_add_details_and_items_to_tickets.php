<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsAndItemsToTickets extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('department')->nullable()->after('order_id');
            $table->string('category')->nullable()->after('reason');
            $table->decimal('return_total', 15, 2)->default(0)->after('status');
            $table->string('account_name')->nullable()->after('return_total');
            $table->string('account_number')->nullable()->after('account_name');
            $table->string('bank_name')->nullable()->after('account_number');
            $table->string('wallet_source')->nullable()->after('bank_name');
        });

        Schema::create('ticket_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->index();
            $table->unsignedBigInteger('ordered_product_id')->nullable()->index();
            $table->string('product_name');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('ordered_product_id')->references('id')->on('ordered_products')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_items');

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'department',
                'category',
                'return_total',
                'account_name',
                'account_number',
                'bank_name',
                'wallet_source',
            ]);
        });
    }
}
