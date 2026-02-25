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

    public $coupon_value;



    public function __construct($order, $settings, $symbol, $sub_total, $coupon_value)
    {

        $this->order = $order;
        $this->settings = $settings;
        $this->currency = $symbol;
        $this->sub_total = $sub_total;
        $this->coupon_value = $coupon_value;
    }


    public function build()
    {
        return $this->subject('Order Confirmation')->view('emails.receipt.index');
    }
}
