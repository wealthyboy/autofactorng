<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $request;


    public function __construct($request, $order)
    {
        $this->order = $order;

        $this->request = $request;
    }

    
    public function build()
    {   
        return $this->subject($this->request->subject)->view('emails.review.index');
    }

}
