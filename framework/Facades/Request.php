<?php

namespace Framework\Facades;

class Request
{

    public static function get(string $key): ?string
    {
        return isset($_GET[$key]) ? filter_var($_GET[$key]) : null;
    }

    public static function post(string $key): ?string
    {
		if (self::isApplicationJson()) {
			$_POST = json_decode(file_get_contents('php://input'), true);
		}
        return isset($_POST[$key]) ? filter_var($_POST[$key]) : null;
    }

    public static function files(string $key): ?array
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

	public static function server(string $key): ?string
	{
		return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
	}

	public static function cookie(string $key): ?string
	{
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}

	private static function isApplicationJson()
	{
		return Request::server('HTTP_ACCEPT') === 'application/json';
	}
}
