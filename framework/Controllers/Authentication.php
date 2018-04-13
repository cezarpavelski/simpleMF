<?php

namespace Framework\Controllers;

use Framework\Database\DB;
use Framework\Translation\Translator;
use Framework\Controllers\BaseController;

class Authentication extends BaseController
{

    public static function login($lang): void
    {
        Translator::setLocale($lang);
        echo self::render('home/main.html');
        //var_dump(DB::execute('select * from users'));
    }

}
