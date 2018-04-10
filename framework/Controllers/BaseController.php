<?php

namespace Framework\Controllers;

use Framework\Templates\Template;

class BaseController
{

    protected static function render(string $pathTeplate, array $params = []): string
    {
        $template = new Template(__DIR__.'/../../views');
        return $template->render($pathTeplate, $params);
    }

}
