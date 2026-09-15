<?php

namespace App\Jobs;

use App\Mail\AbandonedCartMail;
use App\Models\AbandonedCart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendAbandonedCartEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        try {
            AbandonedCart::with(['user', 'items'])
                ->where('recovered', false)
                ->whereNotNull('checkout_started_at')
                ->where('checkout_started_at', '<=', now()->subHour())
                ->whereNull('reminder_sent_at')
                ->orderBy('id')
                ->chunkById(100, function ($carts) {
                    foreach ($carts as $cart) {
                        try {
                            $user = $cart->user;

                            if (! $user || ! $user->email) {
                                continue;
                            }

                            Mail::to($user->email)->send(new AbandonedCartMail($user, $cart));

                            // Never delete an abandoned-cart row after email. The
                            // record is historical analytics data and is also needed
                            // to measure later recovery/conversion accurately.
                            $cart->reminder_sent_at = now();
                            $cart->save();
                        } catch (\Throwable $e) {
                            Log::error('abandoned-cart reminder failed', [
                                'cart_id' => optional($cart)->id,
                                'message' => $e->getMessage(),
                            ]);
                        }
                    }
                });
        } catch (\Throwable $e) {
            Log::error('abandoned-cart reminder job failed', [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
