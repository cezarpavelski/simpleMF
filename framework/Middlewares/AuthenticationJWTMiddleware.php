<?php

namespace Framework\Middlewares;

use Framework\Exceptions\MiddlewareException;
use Framework\Facades\Request;

class AuthenticationJWTMiddleware implements IMiddleware
{

	/**
	 * @return bool
	 * @throws MiddlewareException
	 */
	public static function execute(): bool
    {
		$authorizarion = explode('Bearer ', Request::server('HTTP_AUTHORIZATION'));
		$token = $authorizarion[1];

		$part = explode(".", $token);
		$header = $part[0];
		$payload = $part[1];
		$signature = $part[2];

		$valid = hash_hmac('sha256',"$header.$payload", getenv('APP_KEY'),true);
		$valid = base64_encode($valid);

		if($signature !== $valid){
			throw new MiddlewareException("Unauthorized", 400);
		}

		return true;

    }

}
