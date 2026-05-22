<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndriveSessionIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'indrive_session_id')) {
                $table->string('indrive_session_id')->nullable()->after('acquisition_source_at')->index();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'indrive_session_id')) {
                $table->dropColumn('indrive_session_id');
            }
        });
    }
}
