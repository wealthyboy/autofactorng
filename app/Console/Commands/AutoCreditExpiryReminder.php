<?php

namespace App\Console\Commands;

use App\Notifications\ReminderNotification;
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
        // Notification::route('mail', 'jacob.atam@gmail.com')

        //     ->notify(new ReminderNotification());
    }
}
