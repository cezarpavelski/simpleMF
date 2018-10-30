<?php

namespace Framework\Services;

use Framework\Components\Main as MainComponents;
use Framework\Entities\Page;
use Framework\Facades\Request;

class Pages
{

    public static function new(string $table): array
    {
        $components = MainComponents::render($table);
        return [
            'title' => MainComponents::getTitle($table),
            'table' => $table,
            'components' => $components,
        ];
    }

    public static function save(string $table): array
    {
		MainComponents::executeExtraAction($table);
		$page = new Page($table);

		foreach (MainComponents::getFields($table) as $value) {
			$page->{$value['field']} = Request::post($value['field']);
		}

		$page->insert();

		return [
			'title' => MainComponents::getTitle($table),
			'table' => $table,
			'components' => '<h1>Sucesso</h1>',
		];
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
