<?php

return [

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
