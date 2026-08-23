<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentApprovalToTickets extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable()->after('wallet_source');
            $table->unsignedBigInteger('approved_by')->nullable()->index()->after('approved_at');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['approved_at', 'approved_by']);
        });
    }
}
