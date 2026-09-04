<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddApprovalStatusToTickets extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('approval_status')->nullable()->default('Pending')->after('wallet_source')->index();
        });

        DB::table('tickets')->whereNotNull('approved_at')->update(['approval_status' => 'Approved']);
        DB::table('tickets')->whereNull('approved_at')->update(['approval_status' => 'Pending']);
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
}
