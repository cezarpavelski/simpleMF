<?php

namespace App\Services;

use App\Exceptions\RulesException;

class Rules
{
	public static function canMakeAction(\stdClass $user, int $id_user_action): void
	{
		if ($user->type !== 'admin' && $user->id !== $id_user_action) {
			throw new RulesException('Permission denied', 403);
		}
	}
}
