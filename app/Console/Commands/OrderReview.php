<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingReview;
use Carbon\Carbon;
use App\Notifications\ProductReviewNotification;

class OrderReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:review';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send product review notifications for completed orders.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ✅ Fetch pending reviews with related user and order
        $pendingReview = PendingReview::with(['user', 'order'])
            ->whereHas('user')
            ->whereHas('order')
            ->first();

        if (null !== $pendingReview) {
            $this->info('ℹ️ No pending reviews found.');
            return 0;
        }


        try {
            if ($pendingReview->created_at->diffInDays(Carbon::now()) >= 7) {

                $pendingReview->user->notify(
                    new ProductReviewNotification($pendingReview->user, $pendingReview->order)
                );

                $pendingReview->delete();

                $this->info("✅ Review request sent for Order #{$pendingReview->order->id}");
            }
        } catch (\Exception $e) {
            $this->error("❌ Failed for Order #{$pendingReview->order->id}: " . $e->getMessage());
        }


        $this->info('🎉 All eligible product review notifications sent successfully.');
        return 0;
    }
}
