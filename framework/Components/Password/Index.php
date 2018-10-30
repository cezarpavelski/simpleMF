<?php

namespace Framework\Components\Password;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;

class Index extends AbstractComponent
{

	public function __construct(string $name, string $label, string $value)
	{
		parent::__construct(__DIR__);
		$this->name = $name;
		$this->label = $label;
		$this->value = $value;
	}

    public function render(): string
    {
        return $this->getHtml();
    }

    public static function executeExtraAction(?array $params): void
    {

    }

    public static function parseValue(string $value): string
    {
        return $value;
    }

}
