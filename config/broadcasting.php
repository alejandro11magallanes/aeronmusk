<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
          
          // 'useTLS' => true,
          'host' => env('PUSHER_HOST','127.0.0.1'),
          'port' => env('PUSHER_PORT', 6001),
          'scheme' => env('PUSHER_SCHEME','http'),
          'encrypted' => true,
          'useTLS' => true,
          'cluster' => 'us2',
          'timeout' => 30, // tiempo de espera en segundos
          
          'curl_options' => [
            CURLOPT_TIMEOUT => 30, // tiempo de espera para la conexión y la lectura
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ],
        ],
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


];


