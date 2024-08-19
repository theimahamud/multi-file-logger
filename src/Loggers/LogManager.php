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
        $table = $config['table'] ?? 'logs';

        switch ($connection) {
            case 'sqlite':
                if (isset($config['sqlite']['database'])) {
                    $dsn = "sqlite:{$config['sqlite']['database']}";
                    $pdo = new PDO($dsn, null, null, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);
                } else {
                    throw new \InvalidArgumentException("SQLite configuration is missing 'database' key.");
                }
                break;

            case 'mysql':
            default:
                if (isset($config['mysql'])) {
                    $host = $config['mysql']['host'] ?? '127.0.0.1';
                    $port = $config['mysql']['port'] ?? '3306';
                    $database = $config['mysql']['database'] ?? 'logger';
                    $username = $config['mysql']['username'] ?? 'root';
                    $password = $config['mysql']['password'] ?? '';

                    $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";
                    $pdo = new PDO($dsn, $username, $password, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);
                } else {
                    throw new \InvalidArgumentException('MySQL configuration is missing.');
                }
                break;
        }

        return new DatabaseLogger($pdo, $table);
    }
}
