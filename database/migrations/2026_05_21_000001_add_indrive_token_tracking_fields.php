<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndriveTokenTrackingFields extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'indrive_driver_id')) {
                $table->string('indrive_driver_id')->nullable()->after('indrive_session_id')->index();
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'indrive_driver_id')) {
                $table->string('indrive_driver_id')->nullable()->after('source_channel')->index();
            }
        });

        Schema::table('user_trackings', function (Blueprint $table) {
            if (! Schema::hasColumn('user_trackings', 'indrive_driver_id')) {
                $table->string('indrive_driver_id')->nullable()->after('source_channel')->index();
            }

            if (! Schema::hasColumn('user_trackings', 'indrive_verified')) {
                $table->boolean('indrive_verified')->default(false)->after('indrive_driver_id');
            }
        });
    }

    public function down()
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            if (Schema::hasColumn('user_trackings', 'indrive_verified')) {
                $table->dropColumn('indrive_verified');
            }

            if (Schema::hasColumn('user_trackings', 'indrive_driver_id')) {
                $table->dropColumn('indrive_driver_id');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'indrive_driver_id')) {
                $table->dropColumn('indrive_driver_id');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'indrive_driver_id')) {
                $table->dropColumn('indrive_driver_id');
            }
        });
    }
}
