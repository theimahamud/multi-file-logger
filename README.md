# Multi-file-logger package

Multi-File Logger is a versatile PHP package designed to handle logging across multiple channels and formats. It provides a flexible logging solution that supports various logging mediums, including text files, JSON files, and databases.
This package is ideal for projects that require extensive logging capabilities, enabling you to manage and store logs in different formats and locations efficiently.

## Installation For PHP

You can install the package via composer:

```bash
composer require theimahamud/multi-file-logger
```

## Database Setup

First, create a logs table in your database using the following SQL statement:

```php
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level VARCHAR(100),
    message TEXT,
    context JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Usage

```php
use Rubel9997\MultiFileLogger\Loggers\LogManager;

// Log messages to different channels

$manager = new LogManager([
    'text' => ['path' => 'logs/text-log.txt'],
    'json' => ['path' => 'logs/json-log.json'],
    'stream' => ['path' => 'php://stdout'],
    'database' => [
        'connection' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'logger',
        'username' => 'root',
        'password' => '',
        'table' => 'logs',
    ]
]);

// Log messages to text file
$manager->driver('textFile')->log('info', 'This is a log message in a text file.');

// Log messages to json file
$manager->driver('jsonFile')->log('info', 'This is a log message in JSON format.');

// Log messages to stream
$manager->driver('stream')->log('info', 'This is a log message to stdout.');

// Log messages to database
$manager->driver('database')->log('info', 'This is a log message stored in the database.');
```

<!-- ## Testing

```bash
composer test
``` -->

## Installation For Laravel

You can install the package via Composer:

```bash
composer require theimahamud/multi-file-logger
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

-   [Rubel Mahamud](https://github.com/theimahamud)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
