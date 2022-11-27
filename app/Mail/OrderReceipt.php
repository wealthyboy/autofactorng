<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $settings;

    public $currency;

    public $sub_total;


    public function __construct($order, $settings, $symbol, $sub_total)
    {

        $this->order = $order;
        $this->settings = $settings;
        $this->currency = $symbol;
        $this->sub_total = $sub_total;
    }


    public function build()
    {
        return $this->subject('HauteSignatures Confirmation')->view('emails.receipt.index');
    }
}
