<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Razorpay API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Razorpay payment gateway integration.
    | These values will be loaded from your .env file.
    |
    */

    'key_id' => env('RAZORPAY_API_KEY'),
    'key_secret' => env('RAZORPAY_API_SECRET'),
    
    /*
    |--------------------------------------------------------------------------
    | Razorpay Environment
    |--------------------------------------------------------------------------
    |
    | This determines if you're using the test or live environment
    | For production, change RAZORPAY_ENV=live in your .env file
    | For testing, use RAZORPAY_ENV=test
    |
    */
    'environment' => env('RAZORPAY_ENV', 'test'),
    
    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | Default currency for payments (INR for India)
    |
    */
    'currency' => env('RAZORPAY_CURRENCY', 'INR'),
    
    /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    |
    | Secret key for webhook verification
    |
    */
    'webhook_secret' => env('RAZORPAY_WEBHOOK_SECRET'),
    
    /*
    |--------------------------------------------------------------------------
    | Production Configuration
    |--------------------------------------------------------------------------
    |
    | Settings that automatically adjust based on environment
    |
    */
    'is_live' => env('RAZORPAY_ENV') === 'live',
    'auto_capture' => true,
    'theme_color' => '#9333ea', // Purple theme to match your brand
];
