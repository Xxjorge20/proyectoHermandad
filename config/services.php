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
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // config/services.php
    'paypal' => [
        'client_id' => env('ATrM06oJ54nD4tFoH3ombMYlBg2hHYf4RT3izVuKspDam3y6pU9VLpB8DoDwDARqaLhMZ3WquueCt_ZG'),
        'secret' => env('ECiyRo4rhzeqY3LnzyKIb0HbON6-CQSGQxo5WCpiPgGG3Hwoj0l2mK8iUougGIm7k7RVqm2bDDNAW8Hn'),
        'mode' => env('sandbox'),
    ],


];
