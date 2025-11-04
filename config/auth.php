<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Set default guard to "api" (JWT-based) and default password broker.
    |
    */

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'accounts',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | We define our JWT guard here for API authentication.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'accounts',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'accounts',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Define how we retrieve our users — here we use Eloquent and your
    | AccountManagement model connected to the "account_management" table.
    |
    */

    'providers' => [
        'accounts' => [
            'driver' => 'eloquent',
            'model' => App\Models\AccountManagement::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Password reset settings for accounts (optional).
    |
    */

    'passwords' => [
        'accounts' => [
            'provider' => 'accounts',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Number of seconds before password confirmation expires.
    |
    */

    'password_timeout' => 10800,

];
