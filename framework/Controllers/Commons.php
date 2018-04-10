<?php

namespace Framework\Controllers;

use Framework\Controllers\BaseController;

class Commons extends BaseController
{

    public static function home(): void
    {
        echo self::render('home/main.html');
    }

}
