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
    public $items;

  



     public function __construct($user, $cart)
    {
        $this->user = $user;
        $this->items = collect($cart->cart_items); 
    }

    /**
     * Build the message.
     * 
     * @return $this
     */
    public function build()
    {  
        $this->items->user = $this->user;
        
        return $this->subject("Don't Leave Your Parts Hanging")
                ->bcc('care@autofactorng.com')
                ->markdown('emails.abandoned_cart.index')
                ->with([
                    'user' => $this->user,
                    'items' => $this->items,
                ]);
    }
}
