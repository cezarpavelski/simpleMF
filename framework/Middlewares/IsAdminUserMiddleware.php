<?php

namespace Framework\Middlewares;

use Framework\Exceptions\MiddlewareException;
use Framework\Session\Store as Session;

class IsAdminUserMiddleware implements IMiddleware
{

	/**
	 * @return bool
	 * @throws MiddlewareException
	 */
	public static function execute(): bool
    {
    	$user = Session::get('user');

    	if (is_null($user) || !isset($user['type']) || $user['type'] != 'admin') {
			throw new MiddlewareException("Permission Required", 403);
		}

		return true;
    }

}
