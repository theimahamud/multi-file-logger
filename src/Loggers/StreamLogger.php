<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

class StreamLogger extends AbstractLogger
{
    protected $stream;

    /**
     * Create a new StreamLogger instance and open the stream for writing.
     *
     * @param  string  $stream  Path to the stream resource.
     *
     * @throws \InvalidArgumentException If the stream cannot be opened.
     */
    public function __construct(string $stream)
    {
        $this->stream = @fopen($stream, 'w');
        if (! $this->stream) {
            throw new \InvalidArgumentException("Unable to open stream: {$stream}");
        }
    }

    /**
     * Log a message to the stream with the specified level and context.
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage($level, $message, $context);
        fwrite($this->stream, $formattedMessage);
    }

    /**
     * Close the stream resource when the object is destroyed.
     *
     * @return void
     */
    public function __destruct()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }
}
