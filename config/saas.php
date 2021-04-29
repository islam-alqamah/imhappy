<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Trial days
    |--------------------------------------------------------------------------
    |
    | If you would like to offer trial periods without collecting the user's
    |  payment method information up front.
    |  Otherwise add trial days on plan
    */

    'trial_days' => env('TRIAL_DAYS_NO_PAYMENT_REQUIRE', 10),
    'stripe_product_id' => env('STRIPE_PRODUCT_ID', null),
    'admin_mail' => env('ADMIN_EMAIL', null),
    'demo_mode' => env('DEMO_MODE', false),
    /*
    |--------------------------------------------------------------------------
    | Subscription cancelation reasons
    |--------------------------------------------------------------------------
    |   List all your reasons here
    */
    'cancelation_reasons' => [
        'Too expensive',
        'Lacks features',
        'Not what I expected',
    ],

    'user' => [
        'change_email' => true,
    ],

    'backup' => [
         /*
        |--------------------------------------------------------------------------
        | Laravel Backup Panel Path
        |--------------------------------------------------------------------------
        |
        | This is the URI path where Laravel Backup Panel will be accessible from.
        | Feel free to change this path to anything you like.
        |
        | Note that the URI will not affect the paths of its internal API that
        | aren't exposed to users.
        |
        */

        'path' => 'backup',

        /*
        |--------------------------------------------------------------------------
        | Queue To Run Backup Jobs
        |--------------------------------------------------------------------------
        |
        | You can specify a queue name to use for the jobs to run through.
        |
        | Useful when you don't want to run backup jobs on the same queue as user
        | actions and things that is more time critical.
        |
        */

        'queue' => null,
    ],

];
