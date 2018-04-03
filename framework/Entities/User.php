<?php

namespace Framework\Entities;

use Framework\Entities\BaseModel;

class User extends BaseModel
{
    protected $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    public function __construct($id, $name, $email, $password, $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
    }

}
