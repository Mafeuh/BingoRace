<?php

return [

    'default' => env('BROADCAST_DRIVER', 'null'),

    'connections' => [
        
        'reverb' => [
            'driver' => 'pusher',
            'key' => env('REVERB_APP_KEY', 'laravel-herd'),
            'secret' => env('REVERB_APP_SECRET', 'secret'),
            'app_id' => env('REVERB_APP_ID', '1001'),
            'options' => [
                'host' => env('REVERB_HOST', '127.0.0.1'),
                'port' => env('REVERB_PORT', 6001),
                'scheme' => env('REVERB_SCHEME', 'http'),
                'encrypted' => env('REVERB_SCHEME', 'http') === 'https',
                'useTLS' => env('REVERB_SCHEME', 'http') === 'https',
                'verify' => env('REVERB_SCHEME', 'http') === 'https', // désactivé si http
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
