<?php

namespace Framework\Auth;

use Framework\Entities\User;
use Framework\Exceptions\AuthenticationException;
use Framework\Session\Store as Session;

class AuthenticatorSession
{
	/**
	 * @param string $email
	 * @param string $password
	 * @return User
	 * @throws AuthenticationException
	 */
    public static function authenticate(string $email, string $password): \stdClass
    {
        return self::getUser($email, $password);
    }

	/**
	 * @throws AuthenticationException
	 */
    public static function validate(): void
	{
		if(!Session::get('user')){
			throw new AuthenticationException("Session expired!", 400);
		}
	}

	/**
	 * * @return void
	 */
	public static function destroy(): void {
		session_unset();
		session_destroy();
	}

	private static function cryptPassword(string $password): string
	{
		return hash('sha256', getenv('APP_KEY').$password);
	}

	private static function getUser(string $email, string $password): \stdClass
	{
		$userEntity = new User();
		$user = $userEntity->findWhere(
			"email = ? AND password = ?",
			[$email, self::cryptPassword($password)]
		);

		if(!empty($user)){
			$user = $user[0];
			unset($user->password);
			self::setUserSession($user);

			return $user;
		}
		throw new AuthenticationException("Username or password is invalid!", 404);
	}

	private static function setUserSession(\stdClass $user): void
	{
		Session::set('user', json_encode($user));
	}
}
