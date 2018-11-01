<?php

namespace Framework\Routes;

use Framework\Exceptions\MiddlewareException;
use Framework\Middlewares\MiddlewareExecutor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Framework\View\Template;
use Symfony\Component\Yaml\Exception\ParseException;

class Router
{

	public static function run(): void
	{

		$fileLocator = new FileLocator(array(__DIR__.'/../../routes'));
		$loader = new YamlFileLoader($fileLocator);
		$routes = $loader->load(__DIR__.'/../../routes/app.yml');
		$routes->addCollection($loader->load(__DIR__.'/../../routes/framework.yml'));
		$template = new Template(__DIR__.'/../../views');

		try {
			$context = new RequestContext();
			$context->fromRequest(Request::createFromGlobals());
			$matcher = new UrlMatcher($routes, $context);

			$params = $matcher->match(strtok($_SERVER['REQUEST_URI'], '?'));
			if($params['_middlewares']) {
				MiddlewareExecutor::execute($params['_middlewares']);
			}

			echo call_user_func_array($params['_controller'], self::getMethodParams($params));

		} catch (MiddlewareException $e) {
			echo $template->render("http-errors/error_".$e->getCode().".html");
		} catch (ResourceNotFoundException | ParseException $e) {
			echo $template->render('http-errors/error_404.html');
		}
	}

	private static function getMethodParams(array $params): array
	{
		return array_filter($params, function($key){
			return $key != "_controller" && $key != "_route" && $key != "_middlewares";
		}, ARRAY_FILTER_USE_KEY);
	}

}
