<?php

namespace Framework\Components;

abstract class AbstractComponent
{
    private $dir;
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
        $this->dir = $dir;
    }

    abstract public function render(): void;
    abstract protected function getParams(): array;

    protected function getHtml(): void
    {
        echo $this->template->render('View.html', $this->getParams());
    }

    protected function getStyle(): void
    {
        require $this->dir.'/Style.css';
    }

    protected function getScripts(): void
    {
        require $this->dir.'/Scripts.js';
    }

}
