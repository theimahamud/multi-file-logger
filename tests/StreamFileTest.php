<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Tests;

use PHPUnit\Framework\TestCase;
use Rubel9997\MultiFileLogger\Loggers\LogManager;

class StreamFileTest extends TestCase
{
    private string $tempFile;

    protected function setUp(): void
    {
        // Create a temp file
        $this->tempFile = tempnam(sys_get_temp_dir(), 'stream-log');
    }

    protected function tearDown(): void
    {
        // Remove the temp file after the test
        if (file_exists($this->tempFile)) {
            unlink($this->tempFile);
        }
    }

    public function test_log_store_to_stream_(): void
    {
        // Create an instance of StreamLogger and pass temp path
        $logger = new LogManager(['stream' => ['path' => $this->tempFile]]);

        $logger->driver('stream')->log('info', 'Test stream log message', ['user' => 'Test']);

        // Read the contents from the file
        $logContent = file_get_contents($this->tempFile);

        // Assert that the log entry was written to the stream
        $this->assertStringContainsString('Test stream log message', $logContent);
        $this->assertStringContainsString('info', $logContent);
        $this->assertStringContainsString('{"user":"Test"}', $logContent);
    }
}
