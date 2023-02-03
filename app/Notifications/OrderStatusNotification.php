<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;

class OrderStatusNotification extends Notification
{
    use Queueable;


    public $request;

    public $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$request)
    {
        $this->request = $request;

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
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {   
        
        return (new NexmoMessage)
                    ->content($this->request->message);
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
                    ->subject($this->request->subject)
                    ->greeting('Hello  '. $this->user->fullname() .',')
                    ->line('ORDER  #'.$this->request->orderId)
                    ->line($this->request->message)
                    ->action('View your order', 'https://hautesignatures.com/orders')
                    ->line('Thank you for choosing HauteSignatures!');
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
