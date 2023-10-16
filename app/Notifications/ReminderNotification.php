<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class ReminderNotification extends Notification
{
    use Queueable;

    public $user;

    public $message;

    public $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */


    public function __construct(User $user, $message, $subject = null)
    {
        $this->user = $user;

        $this->message = $message;

        $this->subject = $subject;
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
        $m = (new MailMessage)
            ->bcc('account@autofactorng.com')
            ->bcc('care@autofactorng.com')
            ->subject($this->subject)
            ->greeting('Hello ' . $this->user->name);
        if (is_array($this->message)) {
            foreach ($this->message as $message) {
                $m->line($message);
            }
            if ($this->user->date) {
                $m->line("You shall be able to renew your subscription from {$this->user->date}");
            }
        } else {
            $m->line($this->message);
        }
        $m->action('Click here to visit our website', 'https://autofactorng.com/plans?type=auto_cover');
        $m->line('Thank you for using our service!');

        return $m;
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
