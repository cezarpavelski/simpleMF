<?php

namespace Framework\Database;

interface IActiveRecord
{
    public function find(int $id): \StdClass;
    public function insert(): bool;
    public function update(): bool;
    public function findAll(): array;
    public function findWhere(string $where, array $params): array;
    public function delete(int $id): bool;
    public function paginate(int $count, string $where): array;

}
