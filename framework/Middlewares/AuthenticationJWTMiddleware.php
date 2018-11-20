<?php

namespace Framework\Middlewares;

use Framework\Auth\AuthenticatorJWT;
use Framework\Exceptions\AuthenticationException;
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
		try {
			AuthenticatorJWT::validate($token);
			return true;
		} catch (AuthenticationException $e) {
			throw new MiddlewareException($e->getMessage(), 400);
		}
    }

}
