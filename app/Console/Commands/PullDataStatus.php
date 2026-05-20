<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PullDataStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:data-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count 10,000 times while showing pulling status and complete with a success message.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Pulling data...');

        $bar = $this->output->createProgressBar(10000);
        $bar->start();

        for ($i = 0; $i < 1000; $i++) {
            // Simulate a pull step.
            usleep(100);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Data pulled successfully.');

        return 0;
    }
}
