<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | that can be used to set up security headers on the responses.
    |
    | The 'supports_credentials' is set to true to allow cookie/session-based
    | authentication (necessary for Laravel Sanctum).
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173', // <-- YOUR FRIEND'S REACT URL GOES HERE
        // 'http://your-production-frontend.com',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Leave this as TRUE for authentication

];