<?php

namespace App\Components\Email;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;

class Index extends AbstractComponent
{

    public function __construct()
    {
        parent::__construct(__DIR__);
    }

    public function render(): void
    {
        $this->getHtml();
    }

    protected function getParams(): array
    {
        return [
            'name' => 'email',
            'label' => 'Email',
            'value' => 'email@test.com',
        ];
    }
}
