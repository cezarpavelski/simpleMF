<?php

namespace Framework\Controllers;

use Framework\Controllers\BaseController;
use Framework\Broadcast\Broadcaster;

class Commons extends BaseController
{

    public static function home(): void
    {
        Broadcaster::publish('simple:login', ['username' => 'Cezar']);
        echo self::render('home/main.html');
    }

}
