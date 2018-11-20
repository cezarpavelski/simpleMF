<?php

namespace App\Controllers;

use App\Services\Users as UsersService;
use Framework\Controllers\BaseController;

class Users extends BaseController
{

    public static function save(): string
	{
        return self::json(
        	UsersService::save(),
			201
		);
    }

    public static function update(int $id): string
    {
		return self::json(
			UsersService::update($id),
			200
		);
    }

    public static function delete(int $id): string
    {
		return self::json(
			UsersService::delete($id),
			204
		);
    }

	public static function view(int $id): string
	{
		return self::json(
			UsersService::view($id),
			200
		);
	}

    public static function list(): string
    {
		return self::json(
			UsersService::list(),
		200
		);
    }

}
