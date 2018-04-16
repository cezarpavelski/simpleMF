<?php

namespace Framework\Services;

use Framework\Components\Main as MainComponents;

class Pages
{

    public static function new(string $table): array
    {
        $components = MainComponents::run($table);
        return [
            'table' => $table,
            'components' => $components
        ];
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
