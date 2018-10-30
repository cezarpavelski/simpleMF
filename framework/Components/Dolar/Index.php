<?php

namespace Framework\Components\Dolar;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;
use DOMDocument;
use DOMXPath;

class Index extends AbstractComponent
{

    public function __construct(string $name, string $label, string $value)
    {
        parent::__construct(__DIR__);
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    public function render(): string
    {
        return $this->getHtml();
    }

    public static function executeExtraAction(?array $params): void
    {

    }

    public static function parseValue(string $value): string
    {
        return $value;
    }

    protected function getParams(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->getValueDolar(),
        ];
    }

    private function getValueDolar(): float
    {
        return $this->parseHtmlDolar();
    }

    private function parseHtmlDolar(): float
    {
        $html = $this->getHtmlDolar();
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $nlist = $xpath->query("//*[@id='nacional']");

        return str_replace(',', '.', $nlist[0]->getAttribute('value'));
    }

    private function getHtmlDolar(): string
    {
		$url = "https://dolarhoje.com/";
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$html = curl_exec($ch);
		curl_close($ch);

        return $html;
    }
}
