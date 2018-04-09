<?php

namespace Framework\Services;

use Framework\Components\Main;
use Framework\Templates\Template;

class Components
{

    public static function new(string $table): void
    {
        $components = Main::run($table);
        self::render(['components' => $components]);
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

    private function render(array $params): void
    {
        $template = new Template(__DIR__.'/../../views');
        echo $template->render('components/main.html', $params);
    }

}
