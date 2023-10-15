<?php

namespace App\Console\Commands;

use App\Models\Subscribe;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class AutoCreditExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:autocreditexpiry';

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

        $weeks = Carbon::now()->addDays(14);
        $month = Carbon::now()->addMonth();
        $subscribers = Subscribe::has('user')->get();

        if (null !== $subscribers) {

            $message = [];
            $subject = "Your Subscription expiries 14 days";
            $message[] = "Your Autocover subscription is expiring in 14 days! ";
            $message[] = "It's important to note that any unused credits or benefits after the expiry of the validity period cannot be rolled over or transferred. ";
            $message[] = "Renew to continue enjoying exclusive benefits.";
            $message[] = "Don't miss out on the convenience, savings, and perks of being a loyal subscriber.";

            foreach ($subscribers as  $subscriber) {
                $date = $subscriber->ends_at->format('d/m/y');
                $subscriber->user->date = $date;
                if (null !== $subscriber->user) {
                    Notification::route('mail', optional($subscriber->user)->email)
                        ->notify(new ReminderNotification($subscriber->user, $message,  $subject));
                    $subscriber->sent_expiry = 1;
                    $subscriber->save();
                }
            }
        }
    }
}
//