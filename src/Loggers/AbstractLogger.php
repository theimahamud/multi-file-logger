<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

use Rubel9997\MultiFileLogger\Loggers\LoggerInterface;

abstract class AbstractLogger implements LoggerInterface
{
    protected function formatMessage(string $level, string $message, array $context = []): string
    {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = json_encode($context);
        return "[{$timestamp}] {$level}: {$message} {$contextStr}\n";
    }
}