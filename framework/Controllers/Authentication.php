<?php

namespace Framework\Controllers;

use Framework\Services\User as UserService;

class Authentication extends BaseController
{
    public static function login(): string
    {
        $userService = new UserService();
        try {
            $user = $userService->login();
            return self::render([$user], 'home/main.html');
        } catch (\Exception $e) {
			return self::render([], 'login.html');
        }

    }


    public static function show(): string
    {
        $userService = new UserService();
        try {
            $userService->validateSession();
            return self::render([], 'home/main.html');
        } catch (\Exception $e) {
            return self::render([], 'login.html');
        }
    }

}
