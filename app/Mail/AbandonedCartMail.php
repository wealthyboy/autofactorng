<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbandonedCartMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $item;

    public function __construct($user, $item)
    {
        $this->user = $user;
        $this->item = $item;
    }

    /**
     * Build the message.
     * 
     * @return $this
     */
    public function build()
    {  
        $this->item->user = $this->user;
        return $this->subject("Don't Leave Your Parts Hanging")
                ->cc('care@autofactorng.com')
                ->markdown('emails.abandoned_cart.index')
                ->with([
                    'user' => $this->user,
                    'item' => $this->item,
                ]);
    }
}
