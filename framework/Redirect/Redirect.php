<?php

namespace Framework\Redirect;

use Framework\Facades\Request;

class Redirect
{

	public static function route(string $route, array $params): void
	{
		header('Location: '.self::getUrlRedirect($route).self::generateQueryString($params));
		exit();
	}

	private static function getUrlRedirect(string $route): string {
		return Request::server('REQUEST_SCHEME')."://".Request::server('HTTP_HOST').$route;
	}

	private static function generateQueryString(array $params): string {
		if (!empty($params)) {
			return '?'.http_build_query($params);
		}
		return '';
	}

}