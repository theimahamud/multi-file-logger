<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

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

    /**
     * Log a message to the database with the specified level, message, and context.
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->tableName} (level, message, context, created_at) VALUES (:level, :message, :context, :created_at)");

        $stmt->execute([
            ':level' => $level,
            ':message' => $message,
            ':context' => json_encode($context),
            ':created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
