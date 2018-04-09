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

    protected function getParams(): array
    {
        return [
            'name' => 'input',
            'label' => 'Input',
            'value' => 'value input',
        ];
    }
}
