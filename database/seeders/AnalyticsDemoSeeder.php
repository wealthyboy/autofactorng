<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AnalyticsDemoSeeder extends Seeder
{
    /**
     * Add an idempotent, clearly labelled dataset for manually checking analytics.
     * Run explicitly: php artisan db:seed --class=AnalyticsDemoSeeder
     */
    public function run()
    {
        DB::transaction(function () {
            $now = Carbon::now();
            $products = [
                ['sku' => 'AN-DEMO-BRAKE', 'name' => '[Demo] Brake Pad Set', 'price' => 28000, 'quantity' => 32],
                ['sku' => 'AN-DEMO-OIL', 'name' => '[Demo] Engine Oil', 'price' => 16000, 'quantity' => 4],
                ['sku' => 'AN-DEMO-BATT', 'name' => '[Demo] Car Battery', 'price' => 82000, 'quantity' => 0],
                ['sku' => 'AN-DEMO-FILTER', 'name' => '[Demo] Oil Filter', 'price' => 9000, 'quantity' => 65],
            ];

            foreach ($products as $product) {
                DB::table('products')->updateOrInsert(['sku' => $product['sku']], array_merge($product, [
                    'slug' => strtolower($product['sku']),
                    'allow' => true,
                    'featured' => false,
                    'has_variants' => false,
                    'updated_at' => $now,
                    'created_at' => $now->copy()->subMonths(8),
                ]));
            }

            $productRows = DB::table('products')->whereIn('sku', array_column($products, 'sku'))->get()->keyBy('sku');

            for ($customerNumber = 1; $customerNumber <= 12; $customerNumber++) {
                $email = "analytics.demo{$customerNumber}@example.test";
                $joinedAt = $now->copy()->subDays(($customerNumber * 13) % 170);
                DB::table('users')->updateOrInsert(['email' => $email], [
                    'name' => 'Analytics',
                    'last_name' => "Demo {$customerNumber}",
                    'type' => 'subscriber',
                    'password' => Hash::make('demo-password'),
                    'email_verified_at' => $joinedAt,
                    'updated_at' => $joinedAt,
                    'created_at' => $joinedAt,
                ]);
            }

            $users = DB::table('users')->where('email', 'like', 'analytics.demo%@example.test')->orderBy('id')->get()->values();
            $statuses = ['Delivered', 'Delivered', 'Delivered', 'Processing', 'Confirmed', 'Cancelled'];
            $sources = ['google', 'instagram', 'facebook', 'direct'];

            for ($i = 1; $i <= 42; $i++) {
                $user = $users[$i % $users->count()];
                $product = $products[$i % count($products)];
                $productRow = $productRows[$product['sku']];
                $quantity = ($i % 3) + 1;
                $total = $product['price'] * $quantity;
                $createdAt = $now->copy()->subDays(($i * 4) % 178)->setTime(10 + ($i % 8), 15);
                $invoice = sprintf('AN-DEMO-%04d', $i);

                DB::table('orders')->updateOrInsert(['invoice' => $invoice], [
                    'user_id' => $user->id,
                    'first_name' => 'Analytics',
                    'last_name' => "Demo {$i}",
                    'email' => $user->email,
                    'status' => $statuses[$i % count($statuses)],
                    'total' => (string) $total,
                    'shipping_price' => '2500',
                    'payment_type' => $i % 2 ? 'card' : 'transfer',
                    'order_type' => 'Online',
                    'order_from' => $sources[$i % count($sources)],
                    'updated_at' => $createdAt,
                    'created_at' => $createdAt,
                ]);

                $orderId = DB::table('orders')->where('invoice', $invoice)->value('id');
                DB::table('ordered_products')->updateOrInsert(
                    ['order_id' => $orderId, 'product_id' => $productRow->id],
                    ['product_name' => $product['name'], 'quantity' => $quantity, 'price' => $product['price'], 'total' => (string) $total, 'updated_at' => $createdAt, 'created_at' => $createdAt]
                );
            }

            for ($i = 1; $i <= 120; $i++) {
                $visitedAt = $now->copy()->subDays($i % 175)->setTime(8 + ($i % 12), $i % 60);
                $session = 'analytics-demo-session-' . ($i % 35);
                $product = $productRows[$products[$i % count($products)]['sku']];
                $isSearch = $i % 3 === 0;
                $terms = ['brake pads', 'engine oil', 'battery', 'oil filter'];
                $tracking = [
                    'user_id' => $i % 4 === 0 ? $users[$i % $users->count()]->id : null,
                    'product_id' => $isSearch ? null : $product->id,
                    'page_url' => $isSearch ? url('/search') . '?q=' . urlencode($terms[$i % count($terms)]) : url('/products/' . $product->id),
                    'method' => 'GET',
                    'action' => 'viewed',
                    'referer' => $sources[$i % count($sources)] === 'direct' ? null : 'https://' . $sources[$i % count($sources)] . '.example/',
                    'ip_address' => '192.0.2.' . (($i % 35) + 1),
                    'time_spent' => 35 + ($i % 240),
                    'updated_at' => $visitedAt,
                    'created_at' => $visitedAt,
                ];
                if (Schema::hasColumn('user_trackings', 'source_channel')) {
                    $tracking['source_channel'] = $sources[$i % count($sources)];
                }
                DB::table('user_trackings')->updateOrInsert(['session_id' => $session, 'visited_at' => $visitedAt], $tracking);
            }

            foreach ($users->take(8) as $index => $user) {
                $startedAt = $now->copy()->subDays(($index + 1) * 7);
                DB::table('abandoned_carts')->updateOrInsert(['user_id' => $user->id, 'checkout_started_at' => $startedAt], [
                    'cart_items' => json_encode([['product_id' => $productRows->first()->id, 'quantity' => 1]]),
                    'recovered' => $index % 3 === 0,
                    'updated_at' => $startedAt,
                    'created_at' => $startedAt,
                ]);
            }
        });

        $this->command->info('Analytics demo data seeded. Records are prefixed with AN-DEMO or analytics.demo.');
    }
}
