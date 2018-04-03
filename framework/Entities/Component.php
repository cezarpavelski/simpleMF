<?php

namespace Framework\Entities;

use Framework\Entities\BaseModel;
use StdClass;

class Component extends BaseModel
{
    protected $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

}
