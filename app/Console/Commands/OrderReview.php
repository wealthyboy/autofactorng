<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\ProductReviewNotification;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;


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
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::query()->has('user')->where('allow_review', 1)->get();

        foreach ($orders as $order) {
            if ($order->allow_review && $order->created_at->diffInDays(Carbon::now()) >= 7) {
                if ($order->user) {
                    // ✅ Use user directly — avoids double send
                    $order->user->notify(new \App\Notifications\ProductReviewNotification($order->user, $order));
                } else {
                    // ✅ Only pass the order if user doesn't exist
                    Notification::route('mail', $order->email)
                        ->notify(new \App\Notifications\ProductReviewNotification(null, $order));
                }

                $order->update(['allow_review' => 0]);
            }
        }

        $this->info('✅ Product review notifications sent successfully.');
    }
}
