<?php

    namespace Routes;

    use Symfony\Component\Config\FileLocator;
    use Symfony\Component\Routing\Loader\YamlFileLoader;
    use Symfony\Component\Routing\RequestContext;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Matcher\UrlMatcher;

    class Router
    {

        public static function run()
        {

			$fileLocator = new FileLocator(array(__DIR__));
		    $loader = new YamlFileLoader($fileLocator);
		    $routes = $loader->load('framework.yml');

            try {
                $context = new RequestContext();
                $context->fromRequest(Request::createFromGlobals());
                $matcher = new UrlMatcher($routes, $context);

                $params = $matcher->match($_SERVER['REQUEST_URI']);

                call_user_func_array($params['_controller'], self::getMethodParams($params));

            } catch (\Exception $e) {
                require(__DIR__."/../public/http-errors/error_404.html");
            }
        }

        private function getMethodParams($params)
        {
            return array_filter($params, function($key){
                return $key != "_controller" && $key != "_route";
            }, ARRAY_FILTER_USE_KEY);
        }
    }
