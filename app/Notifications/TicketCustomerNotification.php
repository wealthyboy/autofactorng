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
    private $phase;
    private $message;

    public function __construct(Ticket $ticket, string $phase = 'created', ?string $message = null)
    {
        $this->ticket = $ticket;
        $this->phase = $phase;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $ticket = $this->ticket->loadMissing('order.user');
        $message = $this->message ?: static::messageFor($ticket, $this->phase);

        return (new MailMessage)
            ->subject($this->subjectFor($ticket))
            ->greeting('Dear ' . $this->customerName($ticket) . ',')
            ->line($message)
            ->salutation('Kind regards, Customer Support Team');
    }

    public static function messageFor(Ticket $ticket, string $phase = 'created'): string
    {
        $ticketNumber = $ticket->ticket_number ?: 'Pending';
        $category = $ticket->category ?: 'Escalation';

        if ($phase === 'resolved') {
            if ($category === 'Refund') {
                return "Thank you for your patience.\n\nWe are pleased to inform you that your refund request has been successfully processed.\n\nThe approved refund has been credited to your account.\n\nIf you have any questions or require further assistance, please feel free to contact our Customer Support Team.\n\nThank you for choosing us.";
            }

            if ($category === 'Wallet') {
                return "Thank you for your patience.\n\nWe are pleased to inform you that your wallet credit request has been successfully processed and the approved value has been credited to your store wallet.\n\nIf you need further assistance, please contact our Customer Support Team.";
            }

            return "Thank you for your patience. We’re pleased to inform you that your enquiry/complaint has been resolved and your ticket {$ticketNumber} is now closed.\n\nIf you need further assistance, please contact our customer support team.";
        }

        if ($category === 'Refund') {
            return "Your refund request has been submitted to our Finance Team for processing. Once approved, the refund will be credited to your account within 3–5 working days.\n\nYou will receive a confirmation email once the refund is processed.";
        }

        if ($category === 'Wallet') {
            return "Thank you for your patience.\n\nWe wish to inform you that your wallet credit request has been submitted to our Finance Team for processing. Once approved, the value of the item will be credited to your store wallet.\n\nYou will receive a confirmation email once the wallet credit has been successfully applied to your account.\n\nIf you have any questions or require further assistance, please feel free to contact our Customer Support Team.";
        }

        return "Thank you for contacting us.\n\nYour enquiry/complaint has been logged and escalated to the appropriate team for review. We will update you via email once we have an outcome.\n\nYour Ticket Number is {$ticketNumber}.\n\nThank you for your patience and understanding.";
    }

    private function subjectFor(Ticket $ticket): string
    {
        if ($this->phase === 'resolved') {
            return 'Ticket resolved - ' . $ticket->ticket_number;
        }

        if ($ticket->category === 'Refund') {
            return 'Refund request received - ' . $ticket->ticket_number;
        }

        if ($ticket->category === 'Wallet') {
            return 'Wallet credit request received - ' . $ticket->ticket_number;
        }

        return 'Your support ticket - ' . $ticket->ticket_number;
    }

    private function customerName(Ticket $ticket): string
    {
        $order = $ticket->order;
        $name = $order ? trim((string) $order->fullName()) : '';

        if (! $name && $order && $order->user) {
            $name = trim((string) $order->user->fullname());
        }

        return $name ?: 'Valued Customer';
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
