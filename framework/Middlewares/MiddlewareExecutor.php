<?php

namespace Framework\Middlewares;

use Framework\Exceptions\MiddlewareException;

class MiddlewareExecutor
{

	/**
	 * @param array $middlewares
	 * @return bool
	 * @throws MiddlewareException
	 */
	public static function execute(array $middlewares): bool
	{
		foreach ($middlewares as $middleware) {
			if (!call_user_func($middleware.'::execute')) {
				throw new MiddlewareException('Middleware not pass', 400);
			}
		}

		return true;
	}

}