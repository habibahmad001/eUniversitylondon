<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'authorize' => [
        'login' => env('AUTHORIZE_PAYMENT_API_LOGIN_ID'),
        'key' => env('AUTHORIZE_PAYMENT_TRANSACTION_KEY')
    ],

    'facebook' => [
    'client_id' => '134699947243169',
    'client_secret' => '7ead04d959e8d65de24f78b67326b080',
    'redirect' => env('FACEBOOK_REDIRECT'),
    ],

];
