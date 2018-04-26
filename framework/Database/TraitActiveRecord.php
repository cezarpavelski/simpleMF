<?php

namespace Framework\Database;

use Framework\Database\ActiveRecord;
use StdClass;

trait TraitActiveRecord
{
    private $active_record;

    public function find(int $id): StdClass
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

}
