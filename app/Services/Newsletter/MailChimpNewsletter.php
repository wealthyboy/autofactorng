<?php  namespace App\Services\Newsletter;

use Mailchimp;
use Mailchimp_List_AlreadySubscribed;
use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;

class MailChimpNewsletter implements NewsletterContract
{
    protected $client;

    public function __construct(Mailchimp $client)
    {
        $this->client = $client;
    }

    public function subscribe($listId, $email, $mergeVars = [])
    {   
        try {
            $this->client->lists->subscribe($listId, [
                'email' => $email
                ],  
                $mergeVars, null, false ,true
            );
         } catch (Mailchimp_List_AlreadySubscribed $e) {
            throw new UserAlreadySubscribedException;
        }
    }
}