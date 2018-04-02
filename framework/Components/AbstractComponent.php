<?php

namespace Framework\Components;

abstract class AbstractComponent
{
    private $dir;
    private $template;

    public function __construct(string $dir)
    {
        $loader = new \Twig_Loader_Filesystem($dir);
        $this->template = new \Twig_Environment($loader, array(
            'cache' => __DIR__.'/../../storage/cache',
        ));

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
