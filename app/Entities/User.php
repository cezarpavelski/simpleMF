<?php

namespace App\Entities;

use Framework\Entities\BaseModel;

class User extends BaseModel
{
    protected $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $type;
    public $created_at;

	public function __construct()
	{
		parent::__construct($this->table);
	}

}
