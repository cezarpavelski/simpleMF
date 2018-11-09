<?php

namespace Framework\Entities;

class User extends BaseModel
{
    protected $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $type;
    public $created_at;

    public function __construct($id = NULL, $name = NULL, $email = NULL, $password = NULL, $created_at = NULL)
    {
		parent::__construct($this->table);
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->type = 'admin';
        $this->created_at = $created_at;
    }

}
