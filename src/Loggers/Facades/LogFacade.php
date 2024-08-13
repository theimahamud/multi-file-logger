<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers\Facades;

use Illuminate\Support\Facades\Facade;

class LogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'log-manager';
    }
}
