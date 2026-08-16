<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RepairUserTrackingAnalytics extends Migration
{
    public function up()
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            if (! Schema::hasColumn('user_trackings', 'device_type')) {
                $table->string('device_type', 30)->nullable()->after('user_agent');
            }
            if (! Schema::hasColumn('user_trackings', 'source_channel')) {
                $table->string('source_channel', 100)->nullable()->after('action');
            }
            if (! Schema::hasColumn('user_trackings', 'is_indrive')) {
                $table->boolean('is_indrive')->default(false)->after('source_channel');
            }
            if (! Schema::hasColumn('user_trackings', 'indrive_driver_id')) {
                $table->string('indrive_driver_id')->nullable()->after('is_indrive');
            }
            if (! Schema::hasColumn('user_trackings', 'indrive_verified')) {
                $table->boolean('indrive_verified')->default(false)->after('indrive_driver_id');
            }
        });

        Schema::table('user_trackings', function (Blueprint $table) {
            if (! $this->hasIndex('user_trackings_created_session_idx')) {
                $table->index(['created_at', 'session_id'], 'user_trackings_created_session_idx');
            }
            if (! $this->hasIndex('user_trackings_session_created_idx')) {
                $table->index(['session_id', 'created_at'], 'user_trackings_session_created_idx');
            }
            if (! $this->hasIndex('user_trackings_created_source_idx')) {
                $table->index(['created_at', 'source_channel'], 'user_trackings_created_source_idx');
            }
        });
    }

    public function down()
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            foreach (['user_trackings_created_session_idx', 'user_trackings_session_created_idx', 'user_trackings_created_source_idx'] as $index) {
                if ($this->hasIndex($index)) {
                    $table->dropIndex($index);
                }
            }
        });
    }

    private function hasIndex(string $name): bool
    {
        return collect(DB::select('SHOW INDEX FROM user_trackings'))->contains(function ($index) use ($name) {
            return $index->Key_name === $name;
        });
    }
}
