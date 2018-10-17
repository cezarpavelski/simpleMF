<?php

namespace Framework\Facades;

class Request
{

    public static function get(string $key): string
    {
        return !empty($_GET[$key]) ? filter_var($_GET[$key]) : null;
    }

    public static function post(string $key): string
    {
        return !empty($_POST[$key]) ? filter_var($_POST[$key]) : null;
    }

    public static function files(string $key): array
    {
        return !empty($_FILES[$key]) ? $_FILES[$key] : null;
    }

	public static function server(string $key): array
	{
		return !empty($_SERVER[$key]) ? $_SERVER[$key] : null;
	}

	public static function cookie(string $key): array
	{
		return !empty($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}

}
