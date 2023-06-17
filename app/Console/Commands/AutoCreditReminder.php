<?php

namespace App\Console\Commands;

use App\Models\Subscribe;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class AutoCreditReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:autocreditreminder';

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
        $today = now();

        

        $subscribers = Subscribe::has('user')->where('sent_reminder'. 1)->where("ends_at", "<", $today)->get();

        if (null !== $subscribers) {
            $message_2 = [];

            $message_2[] = "Here's a reminder that your Autocover subscription has expired. ";
            $message_2[] = "Simply visit our website and follow the straightforward steps to renew your subscription. ";
            $message_2[] = "If you have any questions or need assistance with the renewal process, our dedicated support team is here to help.";
            $message_2[] = "Renew to continue enjoying exclusive benefits.";
            $message_2[] = "Renew today and continue enjoying all the advantages that come with being a valued subscriber";

            $subject =  "Subscription Renewal Reminder";

                foreach ($subscribers as  $subscriber) {
                    if (null !== $subscriber->user) {
                    Notification::route('mail', optional($subscriber->user)->email)
                        ->notify(new ReminderNotification($subscriber->user, $message_2, $subject));
                    $subscriber->sent_reminder = false;
                    $subscriber->save();
                }
            }

            
        }


        
    }
}
