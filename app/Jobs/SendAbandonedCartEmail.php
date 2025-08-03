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
    $carts = AbandonedCart::with(['user', 'items'])
        ->where('recovered', false)
        ->where('checkout_started_at', '<=', now()->subHour())
        ->get();

    if ($carts->isNotEmpty()) {
        foreach ($carts as $cart) {
                $user = $cart->user;

                if ($user && $user->email) {
                    Mail::to($user->email)->send(new AbandonedCartMail($user, $cart));
                    $cart->delete();
                }
            }
        }
    }
}
