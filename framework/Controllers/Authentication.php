<?php

namespace Framework\Controllers;

use Framework\Database\DB;
use Framework\Controllers\BaseController;

class Authentication extends BaseController
{

    public static function login($lang): void
    {
        echo self::render('home/main.html', DB::execute('select * from users'));
    }

}
