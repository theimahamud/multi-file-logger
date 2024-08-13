<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

interface LoggerInterface
{
    public function log(string $level, string $message, array $context = []): void;
}