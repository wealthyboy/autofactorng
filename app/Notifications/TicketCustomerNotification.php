<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCustomerNotification extends Notification
{
    use Queueable;

    private $ticket;
    private $comment;

    public function __construct(Ticket $ticket, string $comment)
    {
        $this->ticket = $ticket;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $order = $this->ticket->order;

        return (new MailMessage)
            ->subject('Update on your complaint - ' . $this->ticket->ticket_number)
            ->greeting('Dear Customer,')
            ->line($this->comment)
            ->line('Ticket: ' . $this->ticket->ticket_number)
            ->line('Order: ' . ($order->invoice ?: '#' . $order->id))
            ->line('Reason: ' . $this->ticket->reason)
            ->line('Status: ' . $this->ticket->status)
            ->salutation('AutoFactorNG Customer Care');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
