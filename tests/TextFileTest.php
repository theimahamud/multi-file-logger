<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Tests;

use PHPUnit\Framework\TestCase;
use Rubel9997\MultiFileLogger\Loggers\LogManager;

class TextFileTest extends TestCase
{
    private $testLogFile;

    protected function setUp(): void
    {
        // Create a temp file
        $this->testLogFile = tempnam(sys_get_temp_dir(), 'text-log');
    }

    protected function tearDown(): void
    {
        // Clean up temp file after the test
        if (file_exists($this->testLogFile)) {
            unlink($this->testLogFile);
        }
    }

    public function test_log_store_with_formatted_message_to_text_file(): void
    {
        // Arrange
        //Create an instance of StreamLogger and pass temp path
        $logger = new LogManager(['text' => ['path' => $this->testLogFile]]);

        $level = 'info';
        $message = 'Test log message';
        $context = ['username' => 'TestUser'];

        // Act
        $logger->driver('textFile')->log($level, $message, $context);

        // Assert
        $this->assertFileExists($this->testLogFile);

        $logContents = file_get_contents($this->testLogFile);
        $this->assertStringContainsString($message, $logContents);
        $this->assertStringContainsString($level, $logContents);
        $this->assertStringContainsString(json_encode($context), $logContents);
    }
}
