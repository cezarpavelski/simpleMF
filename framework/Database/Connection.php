<?php

namespace Framework\Database;

use PDO;
use PDOException;

class Connection
{
    private $driver;
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;

    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->port = getenv('DB_PORT');
        $this->database = getenv('DB_DATABASE');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->driver = "mysql:dbname=$this->database;host=$this->host:$this->port";
    }

    public function connect(): PDO {
        try {
            $connection = new PDO($this->driver, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
