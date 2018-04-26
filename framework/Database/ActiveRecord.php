<?php

namespace Framework\Database;

use Framework\Database\Connection;
use Framework\Database\IActiveRecord;
use PDO;
use PDOException;
use StdClass;
use ReflectionObject;
use ReflectionProperty;

class ActiveRecord implements IActiveRecord
{
    private $connection;
    private $class;
    private $table;
    private $params = [];

    public function __construct($class, $table) {
        $this->connection = Connection::connect();
        $this->class = $class;
        $this->table = $table;
    }

    public function find(int $id): StdClass
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table WHERE id = ?");
        $sth->execute([$id]);
        $row = $sth->fetchObject();
        return $row ? $row : new StdClass;
    }

    public function findWhere(string $where, array $params): array
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table WHERE $where");
        $sth->execute($params);
        $rows = $sth->fetchAll(PDO::FETCH_OBJ);
        return count($rows) > 0 ? $rows : [];
    }

    public function insert(): bool
    {
        $placeholder = $this->placeholderInsert();
        try {
            $sth = $this->connection->prepare("INSERT INTO $this->table VALUES ($placeholder)");
            return $sth->execute($this->params);
        } catch (PDOException $e) {
            echo 'insert: '.$e->getMessage();exit;
        }
    }

    public function update(): bool
    {
        $placeholder = $this->placeholderUpdate();
        try {
            $sth = $this->connection->prepare("UPDATE $this->table SET $placeholder WHERE id = ?");
            return $sth->execute($this->params);
        } catch (PDOException $e) {
            echo 'update: '.$e->getMessage();exit;
        }
    }

    public function findAll(): array
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table");
        $sth->execute([]);
        $rows = $sth->fetchAll(PDO::FETCH_OBJ);
        return count($rows) > 0 ? $rows : [];
    }

    // public function delete($id);

    private function placeholderInsert(): string
    {
        $class = new ReflectionObject($this->class);
        foreach($class->getProperties(ReflectionProperty::IS_PUBLIC) as $prop){
            $this->params[] = $this->class->{$prop->getName()};
        }
        return substr(str_repeat('?,',count($this->params)),0,-1);
    }

    private function placeholderUpdate(): string
    {
        $class = new ReflectionObject($this->class);
        foreach($class->getProperties(ReflectionProperty::IS_PUBLIC) as $prop){
            $placeholder[] = $prop->getName().'=?';
            $this->params[] = $this->class->{$prop->getName()};
        }

        $this->params[] = $this->class->id;

        return implode($placeholder,',');
    }

}
