<?php

namespace App\Components\Image;

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
            'name' => 'image',
            'label' => 'Image',
            'value' => '',
        ];
    }
}
