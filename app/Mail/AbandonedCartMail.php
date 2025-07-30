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

    public function __construct($user, $items)
    {
        $this->user = $user;
        $this->items = $items;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Don't Leave Your Parts Hanging")
                ->cc('care@autofactorng.com')
                ->markdown('emails.abandoned')
                ->with([
                    'user' => $this->user,
                    'items' => $this->items,
                ]);
    }
}
