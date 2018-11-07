<?php

namespace Framework\Entities;

use Framework\Database\ActiveRecord;

class BaseModel extends ActiveRecord
{
	public function __construct(string $table)
	{
		parent::__construct($this, $table);
	}
}
