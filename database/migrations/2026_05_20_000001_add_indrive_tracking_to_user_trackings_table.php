<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndriveTrackingToUserTrackingsTable extends Migration
{
    public function up()
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            if (! Schema::hasColumn('user_trackings', 'is_indrive')) {
                $table->boolean('is_indrive')->default(false)->after('action');
            }

            if (! Schema::hasColumn('user_trackings', 'source_channel')) {
                $table->string('source_channel')->nullable()->after('is_indrive');
            }
        });
    }

    public function down()
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            if (Schema::hasColumn('user_trackings', 'source_channel')) {
                $table->dropColumn('source_channel');
            }

            if (Schema::hasColumn('user_trackings', 'is_indrive')) {
                $table->dropColumn('is_indrive');
            }
        });
    }
}
