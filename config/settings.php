<?php

return [

    /* -----------------------------------------------------------------
     |  Default drivers
     | -----------------------------------------------------------------
     | Supported: 'array', 'json', 'database', 'redis'
     */

    'default' => 'json',

    /* -----------------------------------------------------------------
     |  Drivers
     | -----------------------------------------------------------------
     */

    'drivers' => [

        'array' => [
            'driver'  => Digitonma\LaravelSettings\Stores\ArrayStore::class,
        ],

        'json' => [
            'driver'  => Digitonma\LaravelSettings\Stores\JsonStore::class,

            'options' => [
                'path'   => storage_path('app/settings.json'),
            ],
        ],

        'database' => [
            'driver'  => Digitonma\LaravelSettings\Stores\DatabaseStore::class,

            'options' => [
                'connection' => null,
                'table'      => 'settings',
                'model'      => Digitonma\LaravelSettings\Models\Setting::class,
            ],
        ],

        'redis' => [
            'driver'  => Digitonma\LaravelSettings\Stores\RedisStore::class,

            'options' => [
                'client' => 'predis',

                'default' => [
                    'host'     => env('REDIS_HOST', '127.0.0.1'),
                    'port'     => env('REDIS_PORT', 6379),
                    'database' => env('REDIS_DB', 0),
                ],
            ],
        ],

    ],

];
