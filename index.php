<?php

require 'vendor/autoload.php';


use Rubel9997\MultiFileLogger\Loggers\LogManager;
use Rubel9997\MultiFileLogger\Loggers\TextFileLogger;
use Rubel9997\MultiFileLogger\Loggers\StreamLogger;
use Rubel9997\MultiFileLogger\Loggers\JsonFileLogger;

// $logger = new TextFileLogger('logs/text-log.txt');
// $logger->log('info', 'This is a log message');


// $stream = fopen('logs/text-log.txt', 'a');

// $logger = new StreamLogger($stream);
// $logger->log('info', 'This is 2 a log message');

// //// Close the stream when done
// fclose($stream);

// $logger = new JsonFileLogger('logs/json-log.json');
// $logger->log('info', 'This is a log message of json data');


//$dsn = 'mysql:host=localhost;dbname=logger;charset=utf8mb4';
//$username = 'root';
//$password = '';
//
//$pdo = new PDO($dsn, $username, $password, [
//    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//]);
//
//// Instantiate the DatabaseLogger with the PDO connection and table name
//$logger = new DatabaseLogger($pdo, 'logs');
//
//// Log a message to the database
//$logger->log('info', 'This is a log message of json data');

// $logger = new StreamLogger('php://stdout');
// $logger->log('info', 'This message is written to the console.');

$manager = new LogManager([
    'text' => ['path' => 'logs/text-log.txt'],
    'stream' => ['path' => 'php://stdout'],
    'json' => ['path' => 'logs/json-log.json'],
    'database' => [
        'db' => 'logger',
        'username' => 'root',
        'password' => '',
        'table' => 'logs',
    ],
]);

$manager->driver('jsonFile')->log('info', 'This is a log message');