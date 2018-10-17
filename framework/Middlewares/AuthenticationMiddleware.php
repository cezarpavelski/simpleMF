<?php

namespace Framework\Middlewares;

use Framework\Exceptions\MiddlewareException;
use Framework\Session\Store as Session;

class AuthenticationMiddleware implements IMiddleware
{

    public static function execute(): bool
    {
		if(!Session::get('user')){
			throw new MiddlewareException("Unauthorized", 400);
		}

		return true;
    }

}
