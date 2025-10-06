<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailManager;
use App\Services\ZeptoMailTransport; // your custom transport class

class ZeptoMailServiceProvider extends ServiceProvider
{
    public function boot()
    {    
       // dd(true);
        $this->app->make(MailManager::class)->extend('zeptomail', function ($config) {
           // dd($config);
            return new ZeptoMailTransport($config['key']);
        });
    }
}
