<?php

namespace App\Console\Commands;

use Framework\Console\Commands\ICommand;

class GenerateTokenJWTCommand implements ICommand
{
	public function fire(): void
	{
		$header = [
			'alg' => 'HS256',
			'typ' => 'JWT'
		];
		$header = json_encode($header);
		$header = base64_encode($header);

		$payload = [
			'iss' => 'localhost',
			'name' => 'Cezar A. Pavelski',
			'email' => 'cezarpavelski@gmail.com'
		];
		$payload = json_encode($payload);
		$payload = base64_encode($payload);

		$signature = hash_hmac('sha256',"$header.$payload", getenv('APP_KEY'),true);
		$signature = base64_encode($signature);

		echo "$header.$payload.$signature";
	}

}