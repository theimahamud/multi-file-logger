<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Tests;

use PHPUnit\Framework\TestCase;
use Rubel9997\MultiFileLogger\Loggers\LogManager;

class JsonFileTest extends TestCase
{
    private string $tempFile;

    protected function setUp(): void
    {
        // Create a temp file
        $this->tempFile = tempnam(sys_get_temp_dir(), 'json-log');
    }

    protected function tearDown(): void
    {
        // Remove the temp file after the test
        if (file_exists($this->tempFile)) {
            unlink($this->tempFile);
        }
    }

    public function test_log_store_json_file(): void
    {
       // Create instance and pass temp file path
       $logger = new LogManager(['json' => ['path' => $this->tempFile]]);

       $logger->driver('jsonFile')->log('info', 'Test log message', ['username' => 'TestUser']);

       // get the contents
       $logContent = file_get_contents($this->tempFile);
       $logEntries = json_decode($logContent, true);

       // Assert
       $this->assertIsArray($logEntries);
       $this->assertCount(1, $logEntries);

       // Verify the log entry content
       $this->assertEquals('info', $logEntries[0]['level']);
       $this->assertEquals('Test log message', $logEntries[0]['message']);
       $this->assertEquals(['username' => 'TestUser'], $logEntries[0]['context']);
    }

    public function test_log_appends_to_json_file(): void
    {
       // Create instance and pass temp file path
        $logger = new LogManager(['json' => ['path' => $this->tempFile]]);

        $logger->driver('jsonFile')->log('info', 'First log message',['username' => 'TestUser1']);
        $logger->driver('jsonFile')->log('error', 'Second log message',['username' => 'TestUser2']);

        // get the contents
        $logContent = file_get_contents($this->tempFile);
        $logEntries = json_decode($logContent, true);

        // Assert
        $this->assertIsArray($logEntries);
        $this->assertCount(2, $logEntries);

        // Verify the content of each log entry
        $this->assertEquals('info', $logEntries[0]['level']);
        $this->assertEquals('First log message', $logEntries[0]['message']);
        $this->assertEquals(['username' => 'TestUser1'], $logEntries[0]['context']);

        $this->assertEquals('error', $logEntries[1]['level']);
        $this->assertEquals('Second log message', $logEntries[1]['message']);
        $this->assertEquals(['username' => 'TestUser2'], $logEntries[1]['context']);
    }
}
