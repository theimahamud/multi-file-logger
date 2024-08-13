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


        $bindLogManager = function ($app) {
            return new LogManager($app['config']['logger']['drivers']);
        };

        $this->app->singleton('log-manager', $bindLogManager);

        $this->app->bind(LogManager::class, $bindLogManager);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/logger.php' => config_path('logger.php'),
        ], 'logger-config');

        $timestamp = date('Y_m_d_His');
        $this->publishes([
            __DIR__ . '/../../database/migrations/create_logs_table.php' => database_path('migrations/' . $timestamp . '_create_logs_table.php'),
        ], 'logger-migration');
    }
}