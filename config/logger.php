<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Logger
    |--------------------------------------------------------------------------
    |
    | This option controls the default logger that will be used. You may set
    | this to any of the loggers provided by your package: "text", "json",
    | "database", or "stream".
    |
    */

    'default' => 'textFile',

    'drivers' => [

        'text' => [
            'path' => storage_path('logs/text-log.txt'),
        ],

        'stream' => [
            'path' => 'php://stdout',
        ],

        'json' => [
            'path' => storage_path('logs/json-log.json'),
        ],

        'database' => [
            'database' => 'logger',
            'username' => 'root',
            'password' => '',
            'table' => 'logs',
        ],

    ],
];