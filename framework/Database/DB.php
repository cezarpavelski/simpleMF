<?php

namespace Framework\Database;

use Framework\Database\Connection;
use PDO;
use StdClass;

class DB
{

    public static function execute(string $query, array $bindings = []): array
    {
        $connection = Connection::connect();
        $sth = $connection->prepare($query);
        $sth->execute($bindings);
        $rows = $sth->fetchAll(PDO::FETCH_CLASS);
        return $rows ? $rows : [];
    }

}
