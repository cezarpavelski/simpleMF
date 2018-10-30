<?php

namespace Framework\Controllers;

use Framework\Database\DB;
use Framework\Services\Pages as ServicePages;
use Framework\Facades\Request;
use Framework\Components\Image\Index as Image;

class Pages extends BaseController
{

    public static function new(string $table): string
    {
        return self::render(ServicePages::new($table), 'components/main.html');
    }

    public static function save(string $table): string
    {
        Image::executeExtraAction(['file' => [ 'file' => Request::files('image') ] ]);
        return self::render([], 'components/main.html');
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
