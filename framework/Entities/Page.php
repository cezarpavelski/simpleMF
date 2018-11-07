<?php

namespace Framework\Entities;

class Page extends BaseModel
{
    protected $table;

    public function __construct(string $table)
    {
		parent::__construct($table);
		$this->table = $table;
    }

}
