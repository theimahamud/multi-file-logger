<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Tests;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Rubel9997\MultiFileLogger\Loggers\DatabaseLogger;

class DatabaseTest extends TestCase
{
    public function test_log_store_to_database()
    {
        // Arrange
        $tableName = 'logs';

        // Create a mock PDO statement
        $mockStatement = $this->createMock(PDOStatement::class);

        // Expect the execute method to be called once and return true
        $mockStatement->expects($this->once())
            ->method('execute')
            ->with($this->callback(function ($params) {
                // Check if the parameters passed to execute are correct
                return $params[':level'] === 'info' &&
                    $params[':message'] === 'Test log message store to database' &&
                    $params[':context'] === json_encode(['user' => 'Test']) &&
                    isset($params[':created_at']);
            }))
            ->willReturn(true);

        // Create a mock PDO object
        $mockPDO = $this->createMock(PDO::class);

        // Expect the prepare method to be called once and return the mock statement
        $mockPDO->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO {$tableName} (level, message, context, created_at) VALUES (:level, :message, :context, :created_at)")
            ->willReturn($mockStatement);
        // Instantiate the DatabaseLogger with the mock PDO object
        $logger = new DatabaseLogger($mockPDO, $tableName);

        // Act
        $logger->log('info', 'Test log message store to database', ['user' => 'Test']);
    }
}