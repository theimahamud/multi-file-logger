# This is a multi-file-logger package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rubel9997/multi-file-logger.svg?style=flat-square)](https://packagist.org/packages/rubel9997/multi-file-logger)
[![Tests](https://img.shields.io/github/actions/workflow/status/rubel9997/multi-file-logger/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rubel9997/multi-file-logger/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/rubel9997/multi-file-logger.svg?style=flat-square)](https://packagist.org/packages/rubel9997/multi-file-logger)

Multi-File Logger is a versatile PHP package designed to handle logging across multiple channels and formats. It provides a flexible logging solution that supports various logging mediums, including text files, JSON files, and databases.
This package is ideal for projects that require extensive logging capabilities, enabling you to manage and store logs in different formats and locations efficiently.
## Installation For PHP 

You can install the package via composer:

```bash
composer require rubel9997/multi-file-logger
```

## Database Setup

First, create a logs table in your database using the following SQL statement:

```php
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level VARCHAR(20),
    message TEXT,
    context JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Usage

```php
use Rubel9997\MultiFileLogger\Loggers\LogManager;

$manager = new LogManager([
    'text' => ['path' => 'logs/text-log.txt'],
    'stream' => ['path' => 'php://stdout'],
    'json' => ['path' => 'logs/json-log.json'],
    'database' => [
        'database' => 'logger',
        'username' => 'root',
        'password' => '',
        'table' => 'logs',
    ],
]);

// Log messages to different channels
$manager->driver('textFile')->log('info', 'This is a log message in a text file.');
$manager->driver('jsonFile')->log('info', 'This is a log message in JSON format.');
$manager->driver('stream')->log('info', 'This is a log message to stdout.');
$manager->driver('database')->log('info', 'This is a log message stored in the database.');
```

<!-- ## Testing

```bash
composer test
``` -->

## Installation For Laravel 

You can install the package via Composer:

```bash
composer require rubel9997/multi-file-logger
```

After installing the package, you can publish the configuration file to customize the logging channels:

```php
php artisan vendor:publish --provider="Rubel9997\MultiFileLogger\Loggers\LoggerServiceProvider" --tag="logger-config"

```

## Database Setup

Please use a MySQL database connection for testing.

```php
php artisan vendor:publish --provider="Rubel9997\MultiFileLogger\Loggers\LoggerServiceProvider" --tag="logger-migration"
php artisan migrate
```

## Usage

```php
use Rubel9997\MultiFileLogger\Loggers\LogManager;
use Rubel9997\MultiFileLogger\Loggers\Facades\LogFacade;

//use facade for store log with default driver
LogFacade::log('info', 'facade log');

// use multiple driver to store log
LogFacade::driver('textFile')->log('info', 'Facade: Log Message stored in text file.');
LogFacade::driver('jsonFile')->log('info', 'Facade: Log Message stored in JSON file.');
LogFacade::driver('stream')->log('info', 'Facade: Log Message stored in stream.');
LogFacade::driver('database')->log('info', 'Facade: Log Message stored in database.');

//use LogManager class for store log
$manager = app(LogManager::class);
$manager->driver('textFile')->log('info', 'Log Message store.');
$manager->driver('jsonFile')->log('info', 'Log Message store.');
$manager->driver('stream')->log('info', 'Log Message store.');
$manager->driver('database')->log('info', 'Log Message store.');
```

## Credits

- [Rubel Mahamud](https://github.com/rubel9997)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
