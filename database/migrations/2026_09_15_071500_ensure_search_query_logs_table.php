<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureSearchQueryLogsTable extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('search_query_logs')) {
            Schema::create('search_query_logs', function (Blueprint $table) {
                $table->id();
                $table->string('query', 255);
                $table->string('normalized_query', 191)->index();
                $table->unsignedInteger('result_count')->default(0);
                $table->string('session_id', 191)->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();

                $table->index(['result_count', 'created_at'], 'search_query_logs_result_created_idx');
            });

            return;
        }

        $missingNormalized = ! Schema::hasColumn('search_query_logs', 'normalized_query');
        $missingResultCount = ! Schema::hasColumn('search_query_logs', 'result_count');
        $missingSession = ! Schema::hasColumn('search_query_logs', 'session_id');
        $missingUser = ! Schema::hasColumn('search_query_logs', 'user_id');
        $missingIp = ! Schema::hasColumn('search_query_logs', 'ip_address');

        if ($missingNormalized || $missingResultCount || $missingSession || $missingUser || $missingIp) {
            Schema::table('search_query_logs', function (Blueprint $table) use (
                $missingNormalized,
                $missingResultCount,
                $missingSession,
                $missingUser,
                $missingIp
            ) {
                if ($missingNormalized) {
                    $table->string('normalized_query', 191)->nullable()->index();
                }
                if ($missingResultCount) {
                    $table->unsignedInteger('result_count')->default(0);
                }
                if ($missingSession) {
                    $table->string('session_id', 191)->nullable();
                }
                if ($missingUser) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
                if ($missingIp) {
                    $table->string('ip_address', 45)->nullable();
                }
            });
        }
    }

    public function down()
    {
        // Intentionally keep analytics history if this patch is rolled back.
    }
}
