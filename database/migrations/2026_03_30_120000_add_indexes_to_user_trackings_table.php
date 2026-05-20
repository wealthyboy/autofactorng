<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            $table->index('created_at', 'user_trackings_created_idx');
            $table->index(['ip_address', 'created_at'], 'user_trackings_ip_created_idx');
            $table->index(['created_at', 'ip_address', 'id'], 'user_trackings_created_ip_id_idx');
        });
    }

    public function down(): void
    {
        Schema::table('user_trackings', function (Blueprint $table) {
            $table->dropIndex('user_trackings_created_idx');
            $table->dropIndex('user_trackings_ip_created_idx');
            $table->dropIndex('user_trackings_created_ip_id_idx');
        });
    }
};
