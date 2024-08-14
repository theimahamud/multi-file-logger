<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

class TextFileLogger extends AbstractLogger
{
    protected $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Log a message to the text file with the specified level and context.
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage($level, $message, $context);
        try {
            file_put_contents($this->filePath, $formattedMessage, FILE_APPEND);
        } catch (\Exception $e) {
            error_log("Failed to write to log file: {$e->getMessage()}");
        }
    }
}
