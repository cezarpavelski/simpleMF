<?php

namespace App\Components\Input;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;

class Index extends AbstractComponent
{

    public function __construct()
    {
        parent::__construct(__DIR__);
    }

    public function render(): string
    {
        return $this->getHtml();
    }

    public static function executeExtraAction(array $params): void
    {

    }

    public static function parseValue(string $value): string
    {
        return $value;
    }

    protected function getParams(): array
    {
        return [
            'name' => 'input',
            'label' => 'Input',
            'value' => 'value input',
        ];
    }
}
