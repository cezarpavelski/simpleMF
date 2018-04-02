<?php

namespace Framework\Database;
use StdClass;

interface IActiveRecord
{
    public function find(int $id): StdClass;
    public function insert();
    // public function findAll();
    // public function update(int $id);
    // public function delete(int $id);

}
