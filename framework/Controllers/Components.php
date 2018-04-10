<?php

namespace Framework\Controllers;

use Framework\Database\DB;
use Framework\Services\Components as ServiceComponents;
use Framework\Controllers\BaseController;

class Components extends BaseController
{

    public static function new(string $table): void
    {
        echo self::render('components/main.html', ServiceComponents::new($table));
    }

    public static function save(string $table): void
    {
        var_dump(DB::execute('select * from users'));
    }

    public static function update(string $table, int $id): void
    {
        var_dump(DB::execute('select * from users'));
    }

    public static function delete(string $table, int $id): void
    {
        var_dump(DB::execute('select * from users'));
    }

    public static function view(string $table, int $id): void
    {
        var_dump(DB::execute('select * from users'));
    }

    public static function list(string $table): void
    {
        var_dump(DB::execute('select * from users'));
    }

}
