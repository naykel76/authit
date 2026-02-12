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

];
