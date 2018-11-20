<?php

namespace App\Controllers;

use App\Services\Users as UsersService;
use Framework\Auth\AuthenticatorJWT;
use Framework\Controllers\BaseController;
use Framework\Facades\Request;

class Users extends BaseController
{
	public static function authenticate(): string
	{
		try {

			$email = Request::post('email');
			$password = Request::post('password');
			$token = AuthenticatorJWT::authenticate($email, $password);

			return self::json(
				["token" => $token],
				200
			);

		} catch (\Exception $e) {
			return self::json(
				[$e->getCode() => $e->getMessage()],
				$e->getCode()
			);
		}

	}

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
