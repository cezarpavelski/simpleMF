<?php

namespace Framework\Auth;

use Framework\Entities\User;
use Framework\Exceptions\AuthenticationException;

class AuthenticatorJWT
{
	/**
	 * @param string $email
	 * @param string $password
	 * @return array
	 * @throws AuthenticationException
	 */
    public static function authenticate(string $email, string $password): string
    {
		$user = self::getUser($email, $password);
		$header = self::getHeader();
		$payload = self::getPayload($user);
		$signature = self::getSignature($header, $payload);

		return $header.$payload.$signature;
    }

	/**
	 * @param string $token
	 * @throws AuthenticationException
	 */
    public static function validate(string $token): void
	{
		$part = explode(".", $token);
		$header = $part[0];
		$payload = $part[1];
		$signature = $part[2];

		$valid = hash_hmac('sha256',"$header.$payload", getenv('APP_KEY'),true);
		$valid = base64_encode($valid);

		if($signature !== $valid){
			throw new AuthenticationException("Unauthorized", 400);
		}

	}

    private static function getUser(string $email, string $password): \stdClass
	{
		$userEntity = new User();
		$user = $userEntity->findWhere(
			"email = ? AND password = ?",
			[filter_var($email), filter_var($password)]
		);

		if(!empty($user)){
			$user = $user[0];
			unset($user->password);

			return $user;
		}
		throw new AuthenticationException("User not found", 404);
	}

    private static function getHeader(): string
	{
		$header = [
			'alg' => 'HS256',
			'typ' => 'JWT',
		];

		$header = json_encode($header);
		return base64_encode($header);
	}

	private static function getPayload(User $user): string
	{
		$payload = [
			'iss' => 'localhost',
			'user' => $user[0],
		];

		$payload = json_encode($payload);
		return base64_encode($payload);
	}

	private static function getSignature(string $header, string $payload): string
	{
		$signature = hash_hmac('sha256',$header.$payload, getenv('APP_KEY'),true);
		return base64_encode($signature);
	}
}
