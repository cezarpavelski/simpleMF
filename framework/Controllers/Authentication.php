<?php

namespace Framework\Controllers;

use Framework\Services\Authentication as AuthenticatorService;
use Framework\Facades\Request;

class Authentication extends BaseController
{
    public static function login(): void
    {
        try {

			$email = Request::post('email');
			$password = Request::post('password');
            AuthenticatorService::login($email, $password);

            self::redirect( '/');

        } catch (\Exception $e) {
			self::redirect( '/login', [error => $e->getMessage()]);
        }

    }

    public static function logout(): void
	{
		AuthenticatorService::logout();
		self::redirect( '/login');
	}

    public static function show(): string
    {
        try {
			AuthenticatorService::validateSession();
			self::redirect( '/');
        } catch (\Exception $e) {
        	$params = Request::get('error') ? [error => Request::get('error')] : [];
			return self::render($params, 'login.html');
        }
    }

}
