<?php

namespace Framework\Entities;

use Framework\Entities\BaseModel;
use StdClass;

class Page extends BaseModel
{
    protected $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

}
