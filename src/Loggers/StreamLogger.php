<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

class StreamLogger extends AbstractLogger
{
    protected $stream;

    public function __construct(string $stream)
    {
        $this->stream = @fopen($stream, 'w');
        if (! $this->stream) {
            throw new \InvalidArgumentException("Unable to open stream: {$stream}");
        }
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage($level, $message, $context);
        fwrite($this->stream, $formattedMessage);
    }

    public function __destruct()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }
}
