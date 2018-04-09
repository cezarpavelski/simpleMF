<?php

namespace Framework\Controllers;

use Framework\Database\DB;

class Authentication
{

    public static function login(): bool
    {
        var_dump(DB::execute('select * from users'));
        return true;
    }

}
