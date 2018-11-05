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
        return self::render(
        	ServicePages::new($table),
			'pages/save_form.html');
    }

    public static function save(string $table): string
	{
        return self::render(
			ServicePages::save($table),
        	'pages/save_form.html');
    }

    public static function update(string $table, int $id): string
    {
		return self::render(
			ServicePages::update($table, $id),
			'pages/update_form.html');
    }

	public static function edit(string $table, int $id): string
	{
		return self::render(
			ServicePages::edit($table, $id),
			'pages/update_form.html');
	}

    public static function delete(string $table, int $id): void
    {
        var_dump(DB::execute('select * from users'));
    }

    public static function view(string $table, int $id): void
    {
        var_dump(DB::execute('select * from users'));
    }

    public static function list(string $table): string
    {
		return self::render(
			ServicePages::list($table),
			'pages/list_page.html');
    }

}
