<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct() {}

    public function build()
    {


        try {
            return $this->subject('✅ Server Mail Test')
                ->view('emails.test');
        } catch (\Exception $e) {
            \Log::error('Mail build failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
