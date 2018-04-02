<?php

namespace Framework\Database;

use Framework\Database\Connection;
use Framework\Database\IActiveRecord;
use PDO;
use PDOException;
use StdClass;
use ReflectionClass;

class ActiveRecord implements IActiveRecord
{
    private $connection;
    protected $class;

    public function __construct() {
        $this->connection = Connection::connect();
    }

    public function find(int $id): StdClass
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table WHERE id = ?");
        $sth->execute([$id]);
        $row = $sth->fetchObject();
        return $row ? $row : new StdClass;
    }

    public function insert(): bool
    {
        $placeholder = $this->placeholderInsert();
        try {
            $sth = $this->connection->prepare("INSERT INTO $this->table VALUES ($placeholder)");
            return $sth->execute($this->params);
        } catch (PDOException $e) {
            echo $e->getMessage();exit;
        }
    }

    public function update(): bool
    {
        $placeholder = $this->placeholderUpdate();
        try {
            $sth = $this->connection->prepare("UPDATE $this->table SET $placeholder WHERE id = ?");
            return $sth->execute($this->params);
        } catch (PDOException $e) {
            echo $e->getMessage();exit;
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
        $class = new ReflectionClass($this->class);
		foreach($class->getMethods() as $mt){
            $search=strstr($mt->getName(),'get');
			if($search){
				$this->params[] = call_user_func([$this->class, $mt->getName()]);
			}
		}
        return substr(str_repeat('?,',count($this->params)),0,-1);
    }

    private function placeholderUpdate(): string
    {
        $class = new ReflectionClass($this->class);
		foreach($class->getMethods() as $mt){
            $search=strstr($mt->getName(),'get');
			if($search){
				$value = call_user_func([$this->class, $mt->getName()]);
                $placeholder[] = $this->descamelize(substr($mt->getName(), 3)).'=?';
                $this->params[] = $value;
			}
		}
        $this->params[] = $this->class->getId();
        return implode($placeholder,',');
    }

    private function descamelize(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

}
