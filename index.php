<?php

require 'vendor/autoload.php';

use Rubel9997\MultiFileLogger\Loggers\LogManager;

$manager = new LogManager([
    'text' => ['path' => 'logs/text-log.txt'],
    'stream' => ['path' => 'php://stdout'],
    'json' => ['path' => 'logs/json-log.json'],
    'database' => [
        'database' => 'logger',
        'username' => 'root',
        'password' => '',
        'table' => 'logs',
    ],
]);

$manager->driver('textFile')->log('info', 'This is a text log message');
$manager->driver('jsonFile')->log('info', 'This is a json log message');
$manager->driver('stream')->log('info', 'This is a stream log message');
$manager->driver('database')->log('info', 'This is a database log message');
