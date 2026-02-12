<?php

return [

    /**
     * This configuration option allows you to choose between a single `name`
     * field or a `first_name` and `last_name` field when the user registers.
     */
    'use_single_name_field' => env('NK_USE_SINGLE_NAME_FIELD', true),

    /**
     * ----------------------------------------------------------------------
     * Registration Routes
     * ----------------------------------------------------------------------
     * Specify whether to disable the Authit front-end registration routes and
     * user pages. This might be necessary if you only have a back-end.
     *
     * Note: Admin routes and views will still be available.
     */
    'allow_register' => env('NK_ALLOW_REGISTER', true),

];
