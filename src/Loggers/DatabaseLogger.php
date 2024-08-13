<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

use Rubel9997\MultiFileLogger\Loggers\AbstractLogger;
use PDO;

class DatabaseLogger extends AbstractLogger
{
    protected $pdo;
    protected $tableName;

    public function __construct(PDO $pdo, string $tableName)
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->tableName} (level, message, context, timestamp) VALUES (:level, :message, :context, :timestamp)"
        );
        $stmt->execute([
            ':level' => $level,
            ':message' => $message,
            ':context' => json_encode($context),
            ':timestamp' => date('Y-m-d H:i:s')
        ]);
    }
}