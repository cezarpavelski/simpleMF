<?php

namespace Framework\Auth;

use Framework\Session\Store;
use Framework\Entities\User;
use StdClass;

class Authenticator
{
    public static function authenticate(string $email, string $password): array
    {
        $user = new User();
        return $user->findWhere("email = ? AND password = ?", [$email, $password]);
    }
}
