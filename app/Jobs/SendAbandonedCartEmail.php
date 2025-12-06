<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\AbandonedCart;
use Illuminate\Support\Facades\Mail;
use App\Mail\AbandonedCartMail;
use App\Notifications\AbandonedCartFailed;
use Illuminate\Support\Facades\Notification;



class SendAbandonedCartEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $carts = AbandonedCart::with(['user', 'items'])
                ->where('recovered', false)
                ->where('checkout_started_at', '<=', now()->subHour())
                ->get();

            if ($carts->isNotEmpty()) {

                foreach ($carts as $cart) {
                    try {

                        $user = $cart->user;
                        if ($user && $user->email && $cart->items) {
                            Mail::to($user->email)->send(new AbandonedCartMail($user, $cart));
                            $cart->delete();
                        }
                    } catch (\Throwable $e) {

                        dd($e->getMessage());


                        // Notification::route('mail', 'jacob.atam@gmail.com')
                        //     ->notify(new AbandonedCartFailed($e, $cart));
                    }
                }
            }
        } catch (\Throwable $e) {

            dd($e->getMessage());

            // send global job failure notification
            // Notification::route('mail', config('mail.from.address'))
            //     ->notify(new AbandonedCartFailed($e));
        }
    }
}
