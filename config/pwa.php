<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Would you like the install button to appear on all pages?
      Set true/false
    |--------------------------------------------------------------------------
    */

    'install-button' => true,

    /*
    |--------------------------------------------------------------------------
    | PWA Manifest Configuration
    |--------------------------------------------------------------------------
    |  php artisan erag:update-manifest
    */

    'manifest' => [
        'name' => 'dsc.pics - Free Discord Image-Host',
        'short_name' => 'dsc.pics',
        'background_color' => '#0C4A6E',
        'display' => 'fullscreen',
        'description' => 'dsc.pics is a free image hosting service for Discord users.',
        'theme_color' => '#0EA5E9',
        'icons' => [
            [
                'src' => 'logo.png',
                'sizes' => '512x512',
                'type' => 'image/png',
            ],
            [
                'src' => 'logo.png',
                'sizes' => '192x192',
                'type' => 'image/png',
            ],
            [
                'src' => 'logo.png',
                'sizes' => '144x144',
                'type' => 'image/png',
            ],
            [
                'src' => 'logo.png',
                'sizes' => '96x96',
                'type' => 'image/png',
            ],
            [
                'src' => 'logo.png',
                'sizes' => '72x72',
                'type' => 'image/png',
            ],
            [
                'src' => 'logo.png',
                'sizes' => '48x48',
                'type' => 'image/png',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Debug Configuration
    |--------------------------------------------------------------------------
    | Toggles the application's debug mode based on the environment variable
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Livewire Integration
    |--------------------------------------------------------------------------
    | Set to true if you're using Livewire in your application to enable
    | Livewire-specific PWA optimizations or features.
    */

    'livewire-app' => false,
];
