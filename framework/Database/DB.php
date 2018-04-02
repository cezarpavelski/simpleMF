<?php

namespace Framework\Database;

use Framework\Database\Connection;
use PDO;
use StdClass;

class ActiveRecord extends Connection
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
        return $sth->fetchAll(PDO::FETCH_CLASS) ? $sth->fetchAll(PDO::FETCH_CLASS) : new StdClass;
    }

}
