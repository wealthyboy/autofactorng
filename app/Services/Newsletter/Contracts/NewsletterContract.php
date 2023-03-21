<?php

namespace App\Services\Newsletter\Contracts;

interface NewsletterContract
{
    public function subscribe($listId, $email, $mergeVars = []);
}
