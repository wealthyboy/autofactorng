<?php namespace App\Services\Newsletter\Exceptions;

use Exception;

class UserAlreadySubscribedException extends Exception
{
    protected $message = 'You are already subscribed to that list.';
}
