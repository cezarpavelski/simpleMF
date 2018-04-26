<?php

namespace Framework\Controllers;

use Framework\Database\DB;
use Framework\Controllers\BaseController;
use Framework\Services\User as UserService;

class Authentication extends BaseController
{
    public static function login(): void
    {
        $userService = new UserService();
        try {
            $userService->login();
            echo self::render('home/main.html', [$user]);
        } catch (\Exception $e) {
            echo self::render('login.html');
        }

    }


    public static function show(): void
    {
        $userService = new UserService();
        try {
            $userService->validateSession();
            echo self::render('home/main.html', [$user]);
        } catch (\Exception $e) {
            echo self::render('login.html');
        }
    }

}
