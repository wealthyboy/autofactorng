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

        $mail = (new MailMessage)
            ->subject($this->subjectFor($ticket))
            ->greeting($this->greetingFor($ticket));

        foreach ($this->ccRecipients($ticket) as $copyAddress) {
            $mail->cc($copyAddress);
        }

        foreach (preg_split('/\R{2,}/', trim($message)) as $paragraph) {
            $paragraph = trim($paragraph);

            if ($paragraph !== '') {
                $mail->line($paragraph);
            }
        }

        return $mail->salutation("Kind regards,  \nCustomer Support Team");
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
            return "Thank you for contacting AutofactorNG.\n\nWe have received your refund request under ticket {$ticketNumber}, and it has been forwarded to our Finance Team for review and processing.\n\nOnce approved, the refund will be credited to the account details provided within 3–5 working days.\n\nWe will send you a confirmation email as soon as the refund has been successfully processed.\n\nIf you have any questions or require further assistance, please feel free to contact our Customer Support Team.";
        }

        if ($category === 'Wallet') {
            return "Thank you for contacting AutofactorNG.\n\nWe have received your wallet credit request under ticket {$ticketNumber}, and it has been forwarded to our Finance Team for processing.\n\nOnce approved, the applicable amount will be credited to your store wallet.\n\nWe will send you a confirmation email as soon as the wallet credit has been successfully applied.\n\nIf you have any questions or require further assistance, please feel free to contact our Customer Support Team.";
        }

        return "Thank you for contacting AutofactorNG.\n\nWe have received your enquiry/complaint and created ticket {$ticketNumber}.\n\nYour request has been escalated to the appropriate team for review, and we will update you by email as soon as we have an outcome.\n\nThank you for your patience and understanding. If you require further assistance, please feel free to contact our Customer Support Team.";
    }

    private function subjectFor(Ticket $ticket): string
    {
        if ($this->phase === 'update') {
            if ($ticket->category === 'Refund') {
                return 'Update on your refund request - ' . $ticket->ticket_number;
            }

            if ($ticket->category === 'Wallet') {
                return 'Update on your wallet credit request - ' . $ticket->ticket_number;
            }

            if (in_array($ticket->reason, ['Over Payment', 'Double Payment'], true)) {
                return 'Update on your payment issue - ' . $ticket->ticket_number;
            }

            return 'Update on your support request - ' . $ticket->ticket_number;
        }

        if ($this->phase === 'resolved') {
            if ($ticket->category === 'Refund') {
                return 'Your refund has been processed - ' . $ticket->ticket_number;
            }

            if ($ticket->category === 'Wallet') {
                return 'Your wallet credit has been processed - ' . $ticket->ticket_number;
            }

            if (in_array($ticket->reason, ['Over Payment', 'Double Payment'], true)) {
                return 'Your payment issue has been resolved - ' . $ticket->ticket_number;
            }

            return 'Your enquiry/complaint has been resolved - ' . $ticket->ticket_number;
        }

        if ($ticket->category === 'Refund') {
            return 'Refund request received - ' . $ticket->ticket_number;
        }

        if ($ticket->category === 'Wallet') {
            return 'Wallet credit request received - ' . $ticket->ticket_number;
        }

        if (in_array($ticket->reason, ['Over Payment', 'Double Payment'], true)) {
            return 'Payment issue received - ' . $ticket->ticket_number;
        }

        return 'Support request received - ' . $ticket->ticket_number;
    }


    private function greetingFor(Ticket $ticket): string
    {
        if ($ticket->category === 'Escalation') {
            return 'Dear Valued Customer,';
        }

        return 'Dear ' . $this->customerName($ticket) . ',';
    }

    private function ccRecipients(Ticket $ticket): array
    {
        $departmentCopies = [
            'Procurement/Operations' => 'operations@autofactorng.com',
            'Accounts' => 'account@autofactorng.com',
            'Account' => 'account@autofactorng.com',
            'Customer service' => 'care@autofactorng.com',
            'Customer Service' => 'care@autofactorng.com',
            'Logistics' => 'logistics@autofactorng.com',
        ];

        $copies = [
            'justine@autofactorng.com',
            'd@autofactorng.com',
        ];

        if (isset($departmentCopies[$ticket->department])) {
            array_unshift($copies, $departmentCopies[$ticket->department]);
        }

        return array_values(array_unique($copies));
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
