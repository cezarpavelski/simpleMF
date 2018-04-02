<?php

namespace Framework\Database;

use PDO;
use PDOException;

class Connection
{
    private static $driver;
    private static $username;
    private static $password;

    public static function connect(): PDO {
        try {
            self::setup();
            $connection = new PDO(self::$driver, self::$username, self::$password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo 'PDO: '.$e->getMessage();
        }
    }

    private function setup(): void
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $database = getenv('DB_DATABASE');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
        self::$driver = "mysql:dbname=$database;host=$host:$port";
    }
}
