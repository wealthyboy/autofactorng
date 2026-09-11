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
use Illuminate\Support\Facades\Log;
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
                ->whereNull('reminder_sent_at')
                ->get();

            \Log::info($carts);

            if ($carts->isNotEmpty()) {

                foreach ($carts as $cart) {
                    try {

                        $user = $cart->user;

                        Log::info($cart->cart_items);
                        if ($user && $user->email) {
                            Mail::to($user->email)->send(new AbandonedCartMail($user, $cart));

                            // Preserve the row for analytics/history. The previous job
                            // deleted it immediately after sending the reminder, making
                            // abandoned-cart reporting undercount old checkouts.
                            $cart->reminder_sent_at = now();
                            $cart->save();
                        }
                    } catch (\Throwable $e) {

                        Log::error('abandoned-cart reminder failed', [
                            'cart_id' => optional($cart)->id,
                            'message' => $e->getMessage(),
                        ]);


                        // Notification::route('mail', 'jacob.atam@gmail.com')
                        //     ->notify(new AbandonedCartFailed($e, $cart));
                    }
                }
            }
        } catch (\Throwable $e) {

            Log::error('abandoned-cart reminder job failed', [
                'message' => $e->getMessage(),
            ]);

            // send global job failure notification
            // Notification::route('mail', config('mail.from.address'))
            //     ->notify(new AbandonedCartFailed($e));
        }
    }
}
