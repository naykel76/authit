<?php

return [

    /**
     * Use a single 'name' field instead of 'first_name' and 'last_name'
     * when the user registers.
     */
    'split_name_fields' => env('AUTHIT_SPLIT_NAME_FIELDS', false),

    /**
     * Enable public registration routes and pages.
     * When disabled, only admin routes remain available.
     */
    'registration_enabled' => env('AUTHIT_REGISTRATION_ENABLED', true),

    /**
     * Throttle registration attempts per IP to reduce spam and brute force.
     * Format: 'attempts,decay_minutes' e.g. '3,10' = 3 attempts per 10 minutes.
     * Stricter: '2,60' or '1,15'. Looser: '5,1'.
     */
    'registration_throttle' => env('AUTHIT_REGISTRATION_THROTTLE', '3,10'),

    /*
    |--------------------------------------------------------------------------
    | Spam reduction (honeypot is provided by spatie/laravel-honeypot)
    |--------------------------------------------------------------------------
    | To reduce bot signups further: publish honeypot config and increase the
    | minimum time before the form can be submitted, e.g. in .env:
    |   HONEYPOT_SECONDS=5
    | Publish: php artisan vendor:publish --tag=honeypot-config
    */

];
