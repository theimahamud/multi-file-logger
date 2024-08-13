<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

use Rubel9997\MultiFileLogger\Loggers\AbstractLogger;

class JsonFileLogger extends AbstractLogger
{
    protected $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $message,
            'context' => $context
        ];
        file_put_contents($this->filePath, json_encode($logEntry) . "\n", FILE_APPEND);
    }
}