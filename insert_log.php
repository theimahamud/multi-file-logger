<?php

require 'vendor/autoload.php';

use Rubel9997\MultiFileLogger\Loggers\LogManager;

$databasePath = __DIR__ . '/database/database.sqlite';
if (!file_exists($databasePath)) {
    touch($databasePath);
}

//for mysql connection
$manager = new LogManager([
    'text' => ['path' => 'logs/text-log.txt'],
    'stream' => ['path' => 'php://stdout'],
    'json' => ['path' => 'logs/json-log.json'],
    'database' => [
        'connection' => 'mysql',
        'mysql' => [
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'logger',
            'username' => 'root',
            'password' => '',
        ],
        'table' => 'logs',
    ],
]);

//for sqlite connection
// $manager = new LogManager([
//     'text' => ['path' => 'logs/text-log.txt'],
//     'stream' => ['path' => 'php://stdout'],
//     'json' => ['path' => 'logs/json-log.json'],
//     'database' => [
//         'connection' => 'sqlite',
//         'sqlite' => [
//             'database' => $databasePath,
//         ],
//         'table' => 'logs',
//     ],
// ]);

$manager->driver('textFile')->log('info', 'This is a text log message');
$manager->driver('jsonFile')->log('info', 'This is a json log message');
$manager->driver('stream')->log('info', 'This is a stream log message');
$manager->driver('database')->log('info', 'This is a database log message');
