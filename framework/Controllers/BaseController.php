<?php

namespace Framework\Controllers;

use Framework\View\Template;

class BaseController
{

    protected static function render(string $pathTeplate, array $params = []): string
    {
        $template = new Template(__DIR__.'/../../views');
        if(isset($_GET['json'])){
            return json_encode($params);
        }
        return $template->render($pathTeplate, $params);
    }

}
