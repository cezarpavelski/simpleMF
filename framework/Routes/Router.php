<?php

namespace Framework\Routes;

use Framework\Exceptions\MiddlewareException;
use Framework\Middlewares\AuthenticationJWTMiddleware;
use Framework\Middlewares\AuthenticationMiddleware;
use Framework\Middlewares\MiddlewareExecutor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Framework\View\Template;
use Symfony\Component\Yaml\Exception\ParseException;
use Framework\Facades\Request as RequestFramework;

class Router
{

	public static function run(): void
	{

		$fileLocator = new FileLocator(array(__DIR__.'/../../routes'));
		$loader = new YamlFileLoader($fileLocator);
		$routes = $loader->load(__DIR__.'/../../routes/framework.yml');
		$routes->addCollection($loader->load(__DIR__.'/../../routes/app.yml'));
		$template = new Template(__DIR__.'/../../views');

		try {
			$context = new RequestContext();
			$context->fromRequest(Request::createFromGlobals());
			$matcher = new UrlMatcher($routes, $context);

			$params = $matcher->match(strtok($_SERVER['REQUEST_URI'], '?'));

			self::executeAuth();
			self::executeMiddlewares($params);

			echo call_user_func_array($params['_controller'], self::getMethodParams($params));

		} catch (MiddlewareException $e) {
			$rendered = $template->render("http-errors/error_".$e->getCode().".html");
			if (self::isApplicationJson()) {
				$rendered = self::json($e->getMessage(), $e->getCode());
			}
			echo $rendered;
		} catch (ResourceNotFoundException | ParseException | MethodNotAllowedException $e) {
			$rendered = $template->render('http-errors/error_404.html');
			if (self::isApplicationJson()) {
				$rendered = self::json('No routes', 404);
			}
			echo $rendered;
		}
	}

	private static function getMethodParams(array $params): array
	{
		return array_filter($params, function($key){
			return $key != "_controller" && $key != "_route" && $key != "_middlewares";
		}, ARRAY_FILTER_USE_KEY);
	}

	private static function executeMiddlewares(array $params): void
	{
		if($params['_middlewares']) {
			MiddlewareExecutor::execute($params['_middlewares']);
		}
	}

	private static function executeAuth(): void
	{
		$auth = getenv('AUTHENTICATION') ?? 'none';

		switch ($auth) {
			case 'jwt':
				AuthenticationJWTMiddleware::execute();
				break;
			case 'session':
				AuthenticationMiddleware::execute();
				break;
		}

	}

	private static function isApplicationJson(): bool {
		return RequestFramework::server('HTTP_ACCEPT') === 'application/json';
	}

	private static function json(string $message, int $responseCode = 200): string
	{
		header('Content-Type: application/json; charset=utf-8');
		header('Accept: application/json;');
		http_response_code($responseCode);
		return $message;
	}

}
