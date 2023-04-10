<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class AutoCreditNotification extends Notification
{
    use Queueable;


    public $user;

    public $auto_credit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $auto_credit)
    {
        $this->user = $user;

        $this->auto_credit = $auto_credit;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view(
                'emails.auto_credit.index',
                ['u' => $this->user, 'auto_credit' => $this->auto_credit],
            )
            ->cc("care@autofactorng.com")
            ->cc("account@autofactorng.com")
            ->cc("damilola@autofactorng.com")
            ->cc("abiola@autofactorng.com")
            ->subject('Thanks for subscribing');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
