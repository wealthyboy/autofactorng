<?php

namespace App\Services;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;
use GuzzleHttp\Client;

class ZeptoMailTransport extends Transport
{
    protected $client;
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;

       // dd($key);
        $this->client = new Client([
            'base_uri' => 'https://api.zeptomail.com/v1.1/email',
            'headers' => [
                'Authorization' => 'Zoho-enczapikey ' . $this->key,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

     public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        // ✅ Define $from first before using it
        $from = $message->getFrom();
        $fromAddress = key($from);
        $fromName = reset($from) ?: $fromAddress;

        $payload = [
            'from' => [
                'address' => $fromAddress,
                'name'    => $fromName,
            ],
            'to' => $this->formatAddresses($message->getTo()),
            'subject' => $message->getSubject(),
            'htmlbody' => $message->getBody(),
        ];

        // ✅ Add CC if available
        if ($message->getCc()) {
            $payload['cc'] = $this->formatAddresses($message->getCc());
        }

        // ✅ Add BCC if available
        if ($message->getBcc()) {
            $payload['bcc'] = $this->formatAddresses($message->getBcc());
        }

        // ✅ Add Reply-To if available
        if ($message->getReplyTo()) {
            $reply = $message->getReplyTo();
            $replyAddress = key($reply);
            $replyName = reset($reply) ?: $replyAddress;

            $payload['reply_to'] = [
                'address' => $replyAddress,
                'name'    => $replyName,
            ];
        }

        // ✅ Send email through ZeptoMail API
        $response = $this->client->post('email', [
            'json' => $payload,
        ]);

        $this->sendPerformed($message);

        return $response;
    }


    /**
     * Helper to format addresses for ZeptoMail API
     */
    protected function formatAddresses($addresses)
    {
        return collect($addresses)->map(function ($name, $email) {
            return [
                'email_address' => [
                    'address' => $email,
                    'name' => $name ?? '',
                ],
            ];
        })->values()->toArray();
    }
}
