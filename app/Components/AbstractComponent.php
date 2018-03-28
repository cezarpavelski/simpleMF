<?php

namespace App\Components;

abstract class AbstractComponent
{
    private $dir;
    private $template;
    protected $params = [];

    public function __construct(string $dir)
    {
        $loader = new \Twig_Loader_Filesystem($dir);
        $this->template = new \Twig_Environment($loader, array(
            'cache' => __DIR__.'/../../storage/cache',
        ));

        $this->dir = $dir;
    }

    protected function getHtml()
    {
        echo $this->template->render('View.html', $this->params);
    }

    protected function getStyle()
    {
        require $this->dir.'/Style.css';
    }

    protected function getScripts()
    {
        require $this->dir.'/Scripts.js';
    }

}
