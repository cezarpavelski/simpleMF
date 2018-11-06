<?php

namespace Framework\Redirect;

use Framework\Facades\Request;

class Redirect
{

	public static function route(string $route): void
	{
		header('Location: '.self::getUrlRedirect($route));
		exit();
	}

	private static function getUrlRedirect(string $route): string {
		return Request::server('REQUEST_SCHEME')."://".Request::server('HTTP_HOST')."/".$route;
	}

}