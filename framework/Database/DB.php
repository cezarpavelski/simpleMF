<?php

namespace Framework\Database;

use Framework\Database\Connection;
use PDO;
use StdClass;

class DB extends Connection
{
    private $connection;

    public function __construct() {
        parent::__construct();
        $this->connection = $this->connect();
    }

    public function execute(string $query, array $bindings = []): StdClass
    {
        $sth = $this->connection->prepare($query);
        $sth->execute($bindings);
        $rows = $sth->fetchAll(PDO::FETCH_CLASS);
        return $rows ? $rows : new StdClass;
    }

}
