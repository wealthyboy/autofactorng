<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $user_reservation;

    public $settings;

    public function __construct($user_reservation, $settings)
    {
        $this->user_reservation = $user_reservation;

        $this->settings = $settings;
    }


    public function build()
    {
        if ($this->user_reservation->agent === 1) {
            return $this->subject('Reservation Confirmation For ' . optional($this->user_reservation)->apname)->view('emails.receipt.agent_receipt');
        }

        return $this->subject('Reservation Confirmation: Your Stay at Avenue Montaigne')->view('emails.receipt.index');
    }
}
