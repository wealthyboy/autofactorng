<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingReview;
use Carbon\Carbon;
use App\Notifications\ProductReviewNotification;
use Illuminate\Support\Facades\Cache;


class ReviewOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'review:order';

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
        $pendingReviews = PendingReview::where('created_at', '<=', now()->subDays(7))->get();

        foreach ($pendingReviews as $pendingReview) {

            $lock = Cache::lock("review-{$pendingReview->id}", 30);

            if (! $lock->get()) {
                continue;
            }

            try {
                $pendingReview->user->notify(
                    new ProductReviewNotification($pendingReview->user, $pendingReview->order)
                );

                $pendingReview->delete();
            } finally {
                $lock->release();
            }
        }
    }
}
