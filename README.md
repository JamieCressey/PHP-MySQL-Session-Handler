# PHP MySQL Session Handler

This repository contains a custom PHP session handler using MySQL as a backend. The class has been tested successfully using PHP-FPM and HHVM. To get started, it is recommended, although not required, this class is used in conjunction with [PHP-MySQL-PDO-Database-Class](https://github.com/jayc89/php-mysql-pdo-database-class).

## How to Install

#### using [Composer](http://getcomposer.org/)

Create a composer.json file in your project root:
    
```json
{
    "require": {
        "jayc89/php-mysql-session-handler": "dev-master"
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
$db = new Db(); // If using [PHP-MySQL-PDO-Database-Class](https://github.com/jayc89/php-mysql-pdo-database-class)

$handler = new \Jayc89\SessionHandler\SessionHandler();
$handler->setDbConnection($db);
$handler->setDbTable('sessions');
session_set_save_handler($handler, true);
session_start();

```

## Authors

[Jamie Cressey](https://github.com/jayc89)

## License

MIT Public License
