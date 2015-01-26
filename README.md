# PHP MySQL Session Handler

PHP MySQL Session Handler is a PHP MySQL Session Handler written for use with [PHP-MySQL-PDO-Database-Class](https://github.com/jayc89/php-mysql-pdo-database-class)

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
