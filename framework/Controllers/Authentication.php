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

            self::redirect( '/admin');

        } catch (\Exception $e) {
			self::redirect( '/admin/login', [error => $e->getMessage()]);
        }

    }

    public static function logout(): void
	{
		AuthenticatorService::logout();
		self::redirect( '/admin/login');
	}

    public static function show(): string
    {
        try {
			AuthenticatorService::validateSession();
			self::redirect( '/admin');
        } catch (\Exception $e) {
        	$params = Request::get('error') ? [error => Request::get('error')] : [];
			return self::render($params, 'login.html');
        }
    }

}
