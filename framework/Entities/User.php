<?php

namespace Framework\Entities;

use Framework\Entities\BaseModel;
use PDOException;

class User extends BaseModel
{
    protected $table = 'users';
    protected $class;

    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;

    public function __construct($id, $name, $email, $password, $created_at)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->class = $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
}
