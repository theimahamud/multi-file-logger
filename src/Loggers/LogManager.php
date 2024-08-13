<?php

namespace Rubel9997\MultiFileLogger\Loggers;

use PDO;

class LogManager extends Manager
{
    function getDefaultDriver()
    {
        return 'textFile';
    }

    function createStreamDriver(): LoggerInterface
    {
        return new StreamLogger($this->config['stream']['path']);
    }

    function createTextFileDriver(): LoggerInterface
    {
        return new TextFileLogger($this->config['text']['path']);
    }

    function createJsonFileDriver(): LoggerInterface
    {
        return new JsonFileLogger($this->config['json']['path']);
    }

    function createDatabaseDriver(): LoggerInterface
    {
        $db = $this->config['database']['database'];
        $username = $this->config['database']['username'];
        $password = $this->config['database']['password'];

        $dsn = "mysql:host=localhost;dbname={$db};charset=utf8mb4";

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return new DatabaseLogger($pdo, $this->config['database']['table']);
    }
}