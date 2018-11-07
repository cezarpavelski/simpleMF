<?php

namespace Framework\Database;

trait TraitActiveRecord
{
    private $active_record;

    public function find(int $id): \StdClass
    {
        $this->active_record = new ActiveRecord($this, $this->table);
        return $this->active_record->find($id);
    }

    public function findWhere(string $where, array $params): array
    {
        $this->active_record = new ActiveRecord($this, $this->table);
        return $this->active_record->findWhere($where, $params);
    }

    public function insert(): bool
    {
        $this->active_record = new ActiveRecord($this, $this->table);
        return $this->active_record->insert();
    }

    public function update(): bool
    {
        $this->active_record = new ActiveRecord($this, $this->table);
        return $this->active_record->update();
    }

    public function findAll(): array
    {
        $this->active_record = new ActiveRecord($this, $this->table);
        return $this->active_record->findAll();
    }

	public function paginate(int $count, string $where, array $params): array
	{
		$this->active_record = new ActiveRecord($this, $this->table);
		return $this->active_record->paginate($count, $where, $params);
	}

	public function delete(int $id): bool
	{
		$this->active_record = new ActiveRecord($this, $this->table);
		return $this->active_record->delete($id);
	}

	public function count(string $where, array $params): int
	{
		$this->active_record = new ActiveRecord($this, $this->table);
		return $this->active_record->count($where, $params);
	}
}
