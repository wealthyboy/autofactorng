<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddWelcomeOfferFieldsToPromosTable extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('promos', 'title')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->string('title', 120)->nullable()->after('bgcolor');
            });
        }

        if (! Schema::hasColumn('promos', 'message')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->text('message')->nullable()->after('title');
            });
        }

        if (! Schema::hasColumn('promos', 'text_color')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->string('text_color', 20)->default('#ffffff')->after('message');
            });
        }

        if (! Schema::hasColumn('promos', 'accent_color')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->string('accent_color', 20)->default('#111827')->after('text_color');
            });
        }

        if (! Schema::hasColumn('promos', 'cta_text')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->string('cta_text', 60)->nullable()->after('accent_color');
            });
        }

        if (! Schema::hasColumn('promos', 'cta_url')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->string('cta_url', 255)->nullable()->after('cta_text');
            });
        }

        if (! Schema::hasColumn('promos', 'coupon_percent')) {
            Schema::table('promos', function (Blueprint $table) {
                $table->unsignedTinyInteger('coupon_percent')->default(5)->after('cta_url');
            });
        }

        $existing = DB::table('promos')->orderBy('id')->first();

        if ($existing) {
            DB::table('promos')
                ->where('id', $existing->id)
                ->update([
                    'bgcolor' => '#f26522',
                    'title' => 'NEW CUSTOMER OFFER',
                    'message' => 'Create an account today and get {discount}% OFF your next order. Your personal coupon code will be sent to your email after registration.',
                    'text_color' => '#ffffff',
                    'accent_color' => '#111827',
                    'cta_text' => 'CREATE ACCOUNT',
                    'cta_url' => '/register',
                    'coupon_percent' => 5,
                    'is_active' => 1,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('promos')->insert([
                'bgcolor' => '#f26522',
                'title' => 'NEW CUSTOMER OFFER',
                'message' => 'Create an account today and get {discount}% OFF your next order. Your personal coupon code will be sent to your email after registration.',
                'text_color' => '#ffffff',
                'accent_color' => '#111827',
                'cta_text' => 'CREATE ACCOUNT',
                'cta_url' => '/register',
                'coupon_percent' => 5,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        $columns = [
            'title',
            'message',
            'text_color',
            'accent_color',
            'cta_text',
            'cta_url',
            'coupon_percent',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('promos', $column)) {
                Schema::table('promos', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
}
