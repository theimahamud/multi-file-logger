<?php

declare(strict_types=1);

namespace Rubel9997\MultiFileLogger\Loggers;

use Illuminate\Support\ServiceProvider;
use PDO;

class LoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/logger.php', 'logger');

        $this->app->singleton('log-manager', function ($app) {
            return new LogManager($this->app['config']['logger']['drivers']);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/logger.php' => config_path('logger.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}