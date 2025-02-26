<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration determines what cross-origin requests are allowed to
    | interact with your Laravel application. Adjust these settings based on
    | your frontend URL and security requirements.
    |
    */

    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        'login',
        'register',
        'logout'
    ], // Define routes that require CORS

    'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => ['http://localhost:5173'], // Adjust based on your frontend URL

    'allowed_origins_patterns' => [], // Use regex patterns if needed

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [], // Headers exposed to the frontend

    'max_age' => 0, // Cache duration for preflight requests (0 means no caching)

    'supports_credentials' => true, // Required for authentication (e.g., Sanctum with cookies)
];
