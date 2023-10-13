<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\ProductReviewNotification;
use App\Models\Order;
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
        $week = Carbon::now();
        $order = Order::where(['email' => 'hzat01@gmail.com'])->first();

        dd(\DB::table('failed_jobs')->get());

        if (null !== $order) {
            Notification::route('mail', 'hzat01@gmail.com')
                ->notify(new ProductReviewNotification($order->user, $order));

            //foreach ($orders as  $order) {
            // if ($order->created_at->diffInWeeks($week) >= 1 ) {
            //     Notification::route('mail', optional($order->user)->email)
            //     ->notify(new ProductReviewNotification($order->user, $order));
            //     $order->allow_review = false;
            //     $order->save();
            // }
            //}
        }
    }
}
