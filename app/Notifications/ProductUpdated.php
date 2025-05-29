<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProductUpdated extends Notification
{
    use Queueable;

    public $product;
    public $changes;

    public function __construct($product, $changes)
    {
        $this->product = $product;
        $this->changes = $changes;
    }

    public function via($notifiable)
    {
        return ['mail']; // Only mail
    }

    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->subject('Product Updated ') // Email title
            ->greeting('Hello Dami') // Optional greeting line
            ->line("The product \"{$this->product->name}\" has been updated.");

        if (isset($this->changes['price'])) {
            $mail->line("**Price changed**: {$this->changes['price']['old']} → {$this->changes['price']['new']}");
        }

        if (isset($this->changes['quantity'])) {
            $mail->line("**Quantity changed**: {$this->changes['quantity']['old']} → {$this->changes['quantity']['new']}");
        }

        $mail->line('Thank you.');

        return $mail;
    }
}
