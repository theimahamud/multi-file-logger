<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

use PDO;

class LogManager extends Manager
{
    /**
     * Get the default logging driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'textFile';
    }

    /**
     * Create and return a StreamLogger instance.
     */
    public function createStreamDriver(): LoggerInterface
    {
        return new StreamLogger($this->config['stream']['path']);
    }

    /**
     * Create and return a TextFileLogger instance.
     */
    public function createTextFileDriver(): LoggerInterface
    {
        return new TextFileLogger($this->config['text']['path']);
    }

    /**
     * Create and return a JsonFileLogger instance.
     */
    public function createJsonFileDriver(): LoggerInterface
    {
        return new JsonFileLogger($this->config['json']['path']);
    }

    /**
     * Create and return a DatabaseLogger instance.
     */
    public function createDatabaseDriver(): LoggerInterface
    {
        $config = $this->config['database'];

        $connection = $config['connection'] ?? 'mysql';
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '3306';
        $database = $config['database'] ?? 'logger';
        $username = $config['username'] ?? 'root';
        $password = $config['password'] ?? '';
        $table = $config['table'] ?? 'logs';

        $dsn = "{$connection}:host={$host};port={$port};dbname={$database};charset=utf8mb4";

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return new DatabaseLogger($pdo, $table);
    }
}
