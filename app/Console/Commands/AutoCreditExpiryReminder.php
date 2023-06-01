<?php

namespace App\Console\Commands;

use App\Models\Subscribe;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class AutoCreditExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:autocreditexpiryreminder';

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

        $week = Carbon::now()->addWeek(2);
        $month = Carbon::now()->addMonth();

        $subscribers = Subscribe::with('user')->get();

        if (null !== $subscribers) {

            $message = [];
            $subject =  "Your Subscription in 14 days";

            foreach ($subscribers as  $subscriber) {
                $date = $subscriber->ends_at->addDay()->format('d/m/y');
                $message[] = "Your Autocover subscription is expiring in 14 days! ";
                $message[] = "It's important to note that any unused credits or benefits after the expiry of the validity period cannot be rolled over or transferred. ";
                $message[] = "You shall be able to renew your subscription from {$date}";
                $message[] = "Renew to continue enjoying exclusive benefits.";
                $message[] = "Don't miss out on the convenience, savings, and perks of being a loyal subscriber.";
                Notification::route('mail', optional($subscriber->user)->email)
                    ->notify(new ReminderNotification($subscriber->user, $message, $subject));
            }
        }

        $subscribers = Subscribe::with('user')->get();

        if (null !== $subscribers) {
            $message_2 = [];

            $message_2[] = "Here's a reminder that your Autocover subscription has expired. ";
            $message_2[] = "Simply visit our website and follow the straightforward steps to renew your subscription. ";
            $message_2[] = "If you have any questions or need assistance with the renewal process, our dedicated support team is here to help.";
            $message_2[] = "Renew to continue enjoying exclusive benefits.";
            $message_2[] = "Renew today and continue enjoying all the advantages that come with being a valued subscriber";

            $subject =  "Subscription Renewal Reminder";

            foreach ($subscribers as  $subscriber) {
                Notification::route('mail', optional($subscriber->user)->email)
                    ->notify(new ReminderNotification($subscriber->user, $message_2, $subject));
            }
        }


        // $subscribers = Subscribe::with('user')->where("ends_at", ">=", $week)->get();

        // if (null !== $subscribers) {
        //     foreach ($subscribers as  $subscriber) {
        //         Notification::route('mail', optional($subscriber->user)->email)
        //             ->notify(new ReminderNotification($subscriber->user, 14));
        //     }
        // }
    }
}
