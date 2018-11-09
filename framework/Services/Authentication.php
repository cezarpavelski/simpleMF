<?php

namespace Framework\Services;

use Framework\Auth\AuthenticatorSession;

class Authentication
{

    public static function login(string $email, string $password): \stdClass
    {
        $user = AuthenticatorSession::authenticate($email, $password);

        return $user;

    }

    public static function validateSession(): void
    {
        AuthenticatorSession::validate();
    }

    public static function logout(): void
    {
		AuthenticatorSession::destroy();
    }

}
