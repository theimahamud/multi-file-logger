<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

class JsonFileLogger extends AbstractLogger
{
    protected $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Log a message to a JSON file with the specified level, message, and context.
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $message,
            'context' => $context,
        ];

        file_put_contents($this->filePath, json_encode($this->addMessage($logEntry), JSON_PRETTY_PRINT));
    }

    /**
     * Add a new log entry to the existing log entries.
     */
    private function addMessage(array $log): array
    {
        $previousLogs = $this->getPreviousLog();
        $previousLogs[] = $log;

        return $previousLogs;
    }

    /**
     * Retrieve previous log entries from the JSON file.
     */
    private function getPreviousLog(): array
    {
        if (! file_exists($this->filePath)) {
            return [];
        }

        $content = file_get_contents($this->filePath);

        return json_decode($content, true) ?? [];
    }
}
