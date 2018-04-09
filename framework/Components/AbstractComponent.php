<?php

namespace Framework\Components;

use Framework\Templates\Template;

abstract class AbstractComponent
{
    private $dir;
    private $template;

    public function __construct(string $dir)
    {
        $this->template = new Template($dir);
        $this->dir = $dir;
    }

    abstract public function render(): string;
    abstract protected function getParams(): array;

    protected function getHtml(): string
    {
        return $this->template->render('View.html', $this->getParams());
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
