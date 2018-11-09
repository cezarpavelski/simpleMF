<?php

namespace Framework\Controllers;

use Framework\Facades\Request;
use Framework\Redirect\Redirect;
use Framework\View\Template;

class BaseController
{

	protected static function render(array $params = [], string $pathTeplate): string
	{
		$http_accept = Request::server('HTTP_ACCEPT');

		if ($http_accept === 'application/json') {
			return self::json($params, 200);
		} elseif (preg_match("/text\/html/", $http_accept)) {
			return self::html($params, $pathTeplate);
		} else {
			return self::json(['Not Acceptable'], 406);
		}

	}

	protected static function redirect(string $route, array $params = []): void
	{
		Redirect::route($route, $params);
	}

	private static function html(array $params = [], string $pathTeplate): string
	{
		$template = new Template(__DIR__.'/../../views');
		return $template->render($pathTeplate, $params);
	}

	private static function json(array $params = [], int $responseCode = 200): string
	{
		header('Content-Type: application/json; charset=utf-8');
		header('Accept: application/json;');
		http_response_code($responseCode);
		return json_encode($params);
	}

}
