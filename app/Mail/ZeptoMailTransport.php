<?php

namespace App\Mail;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;
use ZeptoMail\ZeptoMailClient;

class ZeptoMailTransport extends Transport
{
    protected $client;

    public function __construct()
    {
        $this->client = new \ZeptoMail\ZeptoMailClient(env('ZEPTO_TOKEN'));
    }

    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $payload = [
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS'),
                'name' => env('MAIL_FROM_NAME'),
            ],
            'subject' => $message->getSubject(),
        ];

        // 🧭 To
        if ($message->getTo()) {
            $payload['to'] = collect($message->getTo())->map(function ($name, $email) {
                return ['email_address' => ['address' => $email, 'name' => $name]];
            })->values()->toArray();
        }

        // 📨 CC
        if ($message->getCc()) {
            $payload['cc'] = collect($message->getCc())->map(function ($name, $email) {
                return ['email_address' => ['address' => $email, 'name' => $name]];
            })->values()->toArray();
        }

        // 🕶 BCC
        if ($message->getBcc()) {
            $payload['bcc'] = collect($message->getBcc())->map(function ($name, $email) {
                return ['email_address' => ['address' => $email, 'name' => $name]];
            })->values()->toArray();
        }

        // 📬 Reply-To
        if ($message->getReplyTo()) {
            $replyTo = collect($message->getReplyTo())->map(function ($name, $email) {
                return ['address' => $email, 'name' => $name];
            })->first();

            if ($replyTo) {
                $payload['reply_to'] = $replyTo;
            }
        }

        // 🧾 Body (HTML + Text)
        $payload['htmlbody'] = $message->getBody();

        if ($message->getChildren()) {
            foreach ($message->getChildren() as $child) {
                if (strpos($child->getContentType(), 'text/plain') === 0) {
                    $payload['textbody'] = $child->getBody();
                }
            }
        }

        // 📎 Attachments
        $attachments = [];
        foreach ($message->getChildren() as $child) {
            if (method_exists($child, 'getBody') && $child->getFilename()) {
                $attachments[] = [
                    'name' => $child->getFilename(),
                    'content' => base64_encode($child->getBody()),
                    'mime_type' => $child->getContentType(),
                ];
            }
        }

        if (!empty($attachments)) {
            $payload['attachments'] = $attachments;
        }

        // 🚀 Send using ZeptoMail API
        $this->client->sendMail($payload);

        $this->sendPerformed($message);
    }
}
