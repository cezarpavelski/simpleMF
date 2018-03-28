<?php

namespace App\Components\Input;

use App\Components\IComponent;
use App\Components\AbstractComponent;

class Index extends AbstractComponent implements IComponent
{

    public function __construct()
    {
        parent::__construct(__DIR__);
    }

    public function render() {
        $this->params['a'] = rand(1, 9999);
        $this->getHtml();
    }
}
