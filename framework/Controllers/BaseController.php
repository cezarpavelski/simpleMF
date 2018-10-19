<?php

namespace Framework\Controllers;

use Framework\Facades\Request;
use Framework\View\Template;

class BaseController
{

	protected static function render(array $params = [], string $pathTeplate): string
	{
		$json = Request::get('json');
		if (isset($json)) {
			$response_code = 200;
			return self::json($params, $response_code);
		}
		return self::html($params, $pathTeplate);

	}

	private static function html(array $params = [], string $pathTeplate): string
	{
		$template = new Template(__DIR__.'/../../views');
		return $template->render($pathTeplate, $params);
	}

	private static function json(array $params = [], int $responseCode = 200): string
	{
		header('Content-Type: application/json; charset=utf-8');
		header('Aceept: application/json;');
		http_response_code($responseCode);
		return json_encode($params);
	}

}
