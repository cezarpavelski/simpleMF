<?php

namespace Framework\Templates;

class Template
{
    private $template;

    public function __construct(string $dir)
    {
        $loader = new \Twig_Loader_Filesystem($dir);
        $cachePath = array();
        if(getenv('CACHE_TEMPLATE') == 'true') {
            $cachePath = array(
                'cache' => __DIR__.'/../../storage/cache',
            );
        }
        $this->template = new \Twig_Environment($loader, $cachePath);
    }

    public function render(string $pathTemplate, array $params): string
    {
        return $this->template->render($pathTemplate, $params);
    }

}
