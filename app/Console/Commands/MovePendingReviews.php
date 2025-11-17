<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\PendingReview;

class MovePendingReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reviews:move';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move eligible orders to the pending_reviews table for review notifications.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ✅ Fetch all orders that qualify (adjust conditions as needed)
        // Example: only completed orders, not yet reviewed
        $orders = Order::query()
            ->where('allow_review', 1) // or use your preferred logic
            ->has('user')
            ->get();

        if ($orders->isEmpty()) {
            $this->info('ℹ️ No eligible orders found.');
            return 0;
        }

        $count = 0;

        foreach ($orders as $order) {
            // Avoid duplicates
            $exists = PendingReview::where('order_id', $order->id)->exists();
            if ($exists) {
                continue;
            }
            PendingReview::truncate();
            PendingReview::create([
                'user_id'  => $order->user_id,
                'order_id' => $order->id,
                'created_at' => $order->created_at
            ]);

            $count++;
        }

        $this->info("✅ Successfully transferred {$count} order(s) to pending_reviews.");
        return 0;
    }
}
