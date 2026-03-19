<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->string('email')->nullable();

            // Section 1: Customer Service Experience
            $table->string('service_satisfaction')->nullable();
            $table->string('resolved_promptly')->nullable();
            $table->string('response_time')->nullable();
            $table->json('support_staff')->nullable();

            // Section 3: Order & Delivery Experience
            $table->string('delivery_satisfaction')->nullable();
            $table->string('delivered_on_time')->nullable();
            $table->string('condition')->nullable();
            $table->string('accurate_description')->nullable();

            // Section 4: Overall Experience
            $table->string('overall_satisfaction')->nullable();
            $table->string('likely_to_purchase_again')->nullable();
            $table->text('improvement_suggestions')->nullable();

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
        Schema::dropIfExists('customer_surveys');
    }
};
