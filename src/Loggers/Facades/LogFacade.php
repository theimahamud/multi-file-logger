<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers\Facades;

use Illuminate\Support\Facades\Facade;
use Rubel9997\MultiFileLogger\Loggers\LogManager;

class LogFacade extends Facade
{

    /**
     * Get the service container key for the 'log-manager'.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LogManager::class;
    }
}
