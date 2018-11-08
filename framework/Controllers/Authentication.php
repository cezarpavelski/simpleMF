<?php

namespace Framework\Controllers;

use Framework\Facades\Request;
use Framework\Services\User as UserService;

class Authentication extends BaseController
{
    public static function login(): string
    {
        $userService = new UserService();
        try {

			$email = Request::post('email');
			$password = Request::post('password');
            $user = $userService->login($email, $password);

            return self::redirect( '/');

        } catch (\Exception $e) {
			return self::render([], 'login.html');
        }

    }


    public static function show(): string
    {
        $userService = new UserService();
        try {
            $userService->validateSession();
            return self::render([], 'home/save_form.html');
        } catch (\Exception $e) {
            return self::render([], 'login.html');
        }
    }

}
