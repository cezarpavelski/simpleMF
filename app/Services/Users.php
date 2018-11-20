<?php

namespace App\Services;

use App\Entities\User;
use Framework\Facades\Request;

class Users
{
	public static function save(): array
	{
		$user = new User();
		$user->id = null;
		$user->name = Request::post('name');
		$user->email = Request::post('email');
		$user->password = Request::post('password');
		$user->type = Request::post('type');
		$user->created_at = date("Y-m-d H:i:s");

		try {
			$user->insert();
			return [$user->last()];
		} catch (\PDOException $e) {
			return [$e->getMessage()];
		}
	}

	public static function update(int $id): array
	{

		$user = new User();
		$user->id = $id;
		$user->name = Request::post('name');
		$user->email = Request::post('email');
		$user->type = Request::post('type');
		$user->created_at = date("Y-m-d H:i:s");

		try {
			$user->update();
			$user_return = $user->find($id);
			unset($user_return->password);
			return [$user_return];
		} catch (\PDOException $e) {
			return [$e->getMessage()];
		}
	}

	public static function delete(int $id): array
	{
		$user = new User();

		try {
			return [$user->delete($id)];
		} catch (\PDOException $e) {
			return [$e->getMessage()];
		}
	}

	public static function view(int $id): array
	{
		$user = new User();

		try {
			$user_return = $user->find($id);
			unset($user_return->password);
			return [$user_return];
		} catch (\PDOException $e) {
			return [$e->getMessage()];
		}
	}

	public static function list(): array
	{
		$user = new User();
		$search_expression = Request::get('search');
		$where[] = '1=1';
		$params = [];

		if ($search_expression) {

			$pieces_search_expression = array_map(function($value) {
				return explode("=", trim($value));
			}, explode(',', $search_expression));

			foreach ($pieces_search_expression as $piece) {
				if ($piece[0]) {
					$where[] = strtolower(trim($piece[0]))."=?";
					$params[] = trim($piece[1]);
				}
			}

		}

		$records = $user->paginate(getenv('RECORDS_PAGINATION'), implode(" and ", $where), $params);

		return $records;
	}

}
