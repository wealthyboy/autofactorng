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
        $orders = Order::query()
            ->has('user')
            ->where('allow_review', 1)
            ->whereDate('created_at', Carbon::today())
            ->get();

        foreach ($orders as $order) {
            if ($order->allow_review == 1) {
                Notification::route('mail', $order->email)
                    ->notify(new ProductReviewNotification($order->user, $order));

                $order->update(['allow_review' => 0]);
            }
        }
    }
}
