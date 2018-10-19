<?php

namespace App\Console\Commands;

use Framework\Console\Commands\ICommand;

class HelloWorldCommand implements ICommand
{
	public $command_name='hello';

	public function fire(): void
	{
		echo 'Hello World';
	}

}