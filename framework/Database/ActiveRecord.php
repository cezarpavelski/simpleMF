<?php

namespace Framework\Database;

use Framework\Database\Connection;
use Framework\Database\IActiveRecord;
use PDO;
use PDOException;
use StdClass;

class ActiveRecord extends Connection implements IActiveRecord
{
    private $connection;
    public $params = [];
    public $table;

    public function __construct() {
        parent::__construct();
        $this->connection = $this->connect();
    }

    public function find(int $id): StdClass
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table WHERE id = ?");
        $sth->execute([$id]);
        return $sth->fetchObject() ? $sth->fetchObject() : new StdClass;
    }

    public function insert(): bool
    {
        $placeholder = $this->getPlaceholder();
        try {
            $sth = $this->connection->prepare("INSERT INTO $this->table VALUES ($placeholder)");
            return $sth->execute($this->params);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();exit;
        }


    }
    // public function findAll();
    // public function update($id);
    // public function delete($id);

    private function getPlaceholder(): string
    {
        return substr(str_repeat('?,',count($this->params)),0,-1);
    }
}
