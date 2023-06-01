<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\ProductReviewNotification;
use App\Models\Order;
use Carbon\Carbon;

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
        $week = Carbon::now()->addWeeks(1);
        $orders = Order::has('user')->get();

        if (null !== $orders) {
            foreach ($orders as  $order) {

                if ($order->created_at->diffInWeeks($week) >= 7 ) {
                    Notification::route('mail', optional($order->user)->email)
                    ->notify(new ProductReviewNotification($order->user, $order));
                }
 
            }
        }
    }
}
