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

        $now = Carbon::now();
        $week = Carbon::now()->addWeek();
        $month = Carbon::now()->addMonth();

        $subscribers = Subscribe::with('user')->where("ends_at", "<", $month)->get();

        if (null !== $subscribers) {
            foreach ($subscribers as  $subscriber) {
                Notification::route('mail', optional($subscriber->user)->email)
                    ->notify(new ReminderNotification($subscriber->user));
            }
        }
    }
}
