<?php

namespace App\Jobs;

use App\Models\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AppendPendingOrderRow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $spreadSheetData;

    public $format;


    /**
     * Create a new job instance.
     */
    public function __construct(array $spreadSheetData, $format)
    {
        $this->spreadSheetData = $spreadSheetData;

        $this->format = $format;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Order::appendPendingOrderRow($this->spreadSheetData, $this->format);
    }
}
