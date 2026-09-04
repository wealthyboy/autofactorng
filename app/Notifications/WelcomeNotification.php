<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Voucher;

class WelcomeNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $discountPercent = null;

        if (! empty($this->user->coupon)) {
            $discountPercent = Voucher::query()
                ->where('code', $this->user->coupon)
                ->value('amount');
        }

        $discountPercent = $discountPercent ? (int) $discountPercent : null;

        $subject = $discountPercent
            ? "Welcome to AutofactorNG — Enjoy {$discountPercent}% OFF Your Next Order!"
            : 'Welcome to AutofactorNG!';

        return (new MailMessage)
            ->view(
                'emails.registration.index',
                [
                    'u' => $this->user,
                    'discountPercent' => $discountPercent,
                ]
            )
            ->bcc(['info@autofactorng.com', 'justine@autofactorng.com'])
            ->subject($subject);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
