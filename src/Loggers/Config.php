<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

use PDO;

class Config
{
    public $uri;

    public $username;

    public $password;

    public function __construct(string $uri, string $username = '', string $password = '')
    {
        $this->uri = $uri;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the URI path.
     */
    public function getPath(): string
    {
        return $this->uri;
    }

    /**
     * Create and return a new PDO instance with the provided configuration.
     *
     * @return PDO
     */
    public function getPDO()
    {
        return new PDO($this->uri, $this->username, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
