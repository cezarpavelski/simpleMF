<?php

namespace Framework\Database;

use Framework\Facades\Request;
use PDO;
use PDOException;
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

    public function find(int $id): \StdClass
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table WHERE id = ?");
        $sth->execute([$id]);
        $row = $sth->fetchObject();
        return $row ? $row : new \StdClass;
    }

    public function findWhere(string $where, array $params): array
    {
        $sth = $this->connection->prepare("SELECT * FROM $this->table WHERE $where");
        $sth->execute($params);
        $rows = $sth->fetchAll(PDO::FETCH_OBJ);

        return count($rows) > 0 ? $rows : [];
    }

	public function count(string $where, array $params): int
	{
		$sth = $this->connection->prepare("SELECT count(*) as total FROM $this->table WHERE $where");
		$sth->execute($params);
		$row = $sth->fetchObject();

		return $row ? $row->total : 0;
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

	public function last(): \StdClass
	{
		$sth = $this->connection->prepare("SELECT * FROM $this->table ORDER BY id DESC LIMIT 1");
		$sth->execute([]);
		$row = $sth->fetchObject();
		return $row ? $row : new \StdClass;
	}

    public function paginate(int $count, string $where, array $params): array
	{
		try {
			$count_total = $this->count($where, $params);
			$page = Request::get('page') || Request::get('page') > 0  ? Request::get('page') : 1;
			$records = $this->findWhere($where." ORDER BY id ASC LIMIT ".($page-1)*$count.", $count", $params);
		} catch (PDOException $e) {
			$count_total = 0;
		}

		$url_info = parse_url(
			Request::server('REQUEST_SCHEME').
			"://".
			Request::server('HTTP_HOST').
			Request::server('REQUEST_URI')
		);

		$url_next = $url_info['scheme'].'://'.$url_info['host'].$url_info['path'].'?page='.($page+1);
		$url_previous = $url_info['scheme'].'://'.$url_info['host'].$url_info['path'].'?page='.($page-1);

		if ($count_total === 0) {
			return [];
		}

		return [
			'total' => $count_total,
			'total_pages' => ceil($count_total/$count),
			'records_per_page' => $count,
			'page_active' => $page,
			'previous' => ($page-1 > 0) ? $url_previous : null,
			'next' => ($count_total > 0 && ($page * $count) < $count_total) ? $url_next : null,
			'records' => $records,
		];
	}

    public function delete(int $id): bool
	{
		try {
			$sth = $this->connection->prepare("DELETE FROM $this->table WHERE id = ?");
			return $sth->execute([$id]);
		} catch (PDOException $e) {
			echo 'delete: '.$e->getMessage();exit;
		}
	}

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
        	if (!is_null($this->class->{$prop->getName()})) {
				$placeholder[] = $prop->getName() . '=?';
				$this->params[] = $this->class->{$prop->getName()};
			}
        }

        $this->params[] = $this->class->id;

        return implode($placeholder,',');
    }

}
