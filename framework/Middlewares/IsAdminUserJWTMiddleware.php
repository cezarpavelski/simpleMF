<?php

namespace Framework\Middlewares;

use App\Entities\User;
use Framework\Exceptions\MiddlewareException;
use Framework\Facades\Request;

class IsAdminUserJWTMiddleware implements IMiddleware
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
		$payload = base64_decode($part[1]);
		$payload = json_decode($payload);

		$user = new User();
		$user_find = $user->find($payload->user->id);

    	if (!$user_find || $user_find->type !== 'admin') {
			throw new MiddlewareException("Permission Required", 403);
		}

		return true;
    }

}
