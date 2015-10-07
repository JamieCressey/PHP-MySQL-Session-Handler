# PHP MySQL Session Handler

[![Latest Stable Version](https://poser.pugx.org/jamiecressey/php-mysql-session-handler/v/stable.png)](https://packagist.org/packages/jamiecressey/php-mysql-session-handler)
[![Total Downloads](https://poser.pugx.org/jamiecressey/php-mysql-session-handler/downloads.png)](https://packagist.org/packages/jamiecressey/php-mysql-session-handler)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/jamiecressey/php-mysql-session-handler/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

This repository contains a custom PHP session handler using MySQL as a backend. The class has been tested successfully using PHP-FPM and HHVM. To get started, it is recommended, although not required, this class is used in conjunction with [PHP-MySQL-PDO-Database-Class](https://github.com/JamieCressey/php-mysql-pdo-database-class).

## How to Install

#### using [Composer](http://getcomposer.org/)

Create a composer.json file in your project root:
    
```json
{
    "require": {
        "jamiecressey/php-mysql-session-handler": "dev-master"
    }
}
```

Then run the following composer command:

```bash
$ php composer.phar install
```

## How to use

```sql
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` varchar(32) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT NULL,
    `data` mediumtext,
    PRIMARY KEY (`id`),
    KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

```

```sh
require 'vendor/autoload.php';
$handler = new \JamieCressey\SessionHandler\SessionHandler();

// Pass DB details to create a new MySQLi connection
$handler->setDbDetails('localhost', 'username', 'password', 'database');
// OR alternatively, inject an existing MySQLi resource
// $db = new Db(); // See: https://github.com/jamiecressey/php-mysql-pdo-database-class
// $handler->setDbConnection($db);

$handler->setDbConnection($db);
$handler->setDbTable('sessions');
session_set_save_handler($handler, true);
session_start();

```

## Authors

[Jamie Cressey](https://github.com/JamieCressey)

## License

MIT Public License
