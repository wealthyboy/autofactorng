<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */



    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.eu.mailgun.net'),
    ],
    'mailchimp' => [
        'secret' => env('MAILCHIMP_SECRET'),
        'list' => env('MAILCHIMP_LISTID'),
    ],
    'termii' => [
        'api_key' => env('TERMII_API_KEY'),
        'phonebook_id' => env('TERMII_PHONEBOOK_ID'),
        'company' => env('TERMII_COMPANY', 'AutofactorNG'),
        'country_code' => env('TERMII_COUNTRY_CODE', '234'),
    ],
    'zepto' => [
        'api_key' => env('ZEPTO_API_KEY'),
        'api_url' => env('ZEPTO_API_URL', 'https://api.zeptomail.com/v1.1/email'),
    ],


    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],
    'sheets' => [
        'service_account_credentials_json' => env('GOOGLE_APPLICATION_CREDENTIALS'),
        'client_id' => env('GOOGLE_SPREADSHEET_ID'),
        'client_id_2' => env('GOOGLE_SHEET_ID'),
    ],
    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY', env('MIX_RECAPTCHA_SITE_KEY')),
        'secret' => env('RECAPTCHA_SECRET_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'whatsapp' => [
        'access_token' => env('WHATSAPP_TOKEN'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
        'api_version' => env('WHATSAPP_API_VERSION', 'v18.0'),
    ]

];
