<?php

namespace Framework\Components;

use Framework\View\Template;

abstract class AbstractComponent
{
    private $dir;
    private $template;

    protected $name;
    protected $label = null;
    protected $value = null;

    public function __construct(string $dir)
    {
        $this->template = new Template($dir);
        $this->dir = $dir;
    }

    abstract public static function executeExtraAction(?array $params): void;
    abstract public static function parseValue(string $value): string;
    abstract public function render(): string;

    protected function getParams(): array
	{
		return [
			'name' => $this->name,
			'label' => $this->label,
			'value' => 0,
		];
	}

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
