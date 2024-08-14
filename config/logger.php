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

        /*
        |--------------------------------------------------------------------------
        | Text File Logger Configuration
        |--------------------------------------------------------------------------
        |
        | Configuration for the text file logger. The 'path' option specifies
        | where the log file will be stored.
        |
        */

        'text' => [
            'path' => storage_path('logs/text-log.txt'),
        ],

        /*
        |--------------------------------------------------------------------------
        | Stream Logger Configuration
        |--------------------------------------------------------------------------
        |
        | Configuration for the stream logger. The 'path' option specifies the
        | stream resource to write logs to, such as 'php://stdout'.
        |
        */

        'stream' => [
            'path' => 'php://stdout',
        ],

        /*
        |--------------------------------------------------------------------------
        | JSON File Logger Configuration
        |--------------------------------------------------------------------------
        |
        | Configuration for the JSON file logger. The 'path' option specifies
        | where the JSON log file will be stored.
        |
        */

        'json' => [
            'path' => storage_path('logs/json-log.json'),
        ],

        /*
        |--------------------------------------------------------------------------
        | Database Logger Configuration
        |--------------------------------------------------------------------------
        |
        | Configuration for the database logger. This includes the database connection
        | details and the table name for storing logs. These values should be consistent
        | with your Laravel database configuration.
        |
        */

        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'logger'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'table' => 'logs',
        ],
    ],
];
