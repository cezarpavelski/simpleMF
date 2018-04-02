<?php

namespace App\Components\Textarea;

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
            'name' => 'textarea',
            'label' => 'Textarea',
            'value' => 'value textarea',
        ];
    }
}
