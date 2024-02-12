<?php

return [

    /**
     * This configuration option allows you to choose between a single `name`
     * field or a `firstname` and `lastname` field when the user registers.
     */
    'use_single_name_field' => env('NK_USE_SINGLE_NAME_FIELD', true),

    /**
     * ----------------------------------------------------------------------
     * Registration Routes
     * ----------------------------------------------------------------------
     * Here you may specify if the Authit front-end registration routes and
     * user pages should be disabled as you may not need them when building
     * your own application. Admin routes and views are still available.
     *
     */

    'allow_register' => env('NK_ALLOW_REGISTER', true),

    /**
     * ----------------------------------------------------------------------
     * Registration Routes
     * ----------------------------------------------------------------------
     * Here you may specify if application has a user dashboard or not. If
     * there is no dashboard then the user will be redirected to the
     * `user.account` page after login.
     *
     *
     * this is handled during the install process
     *
     */

    'user_dashboard' => env('NK_USER_DASHBOARD', false),

];
