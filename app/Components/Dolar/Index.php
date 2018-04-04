<?php

namespace App\Components\Dolar;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;
use DOMDocument;
use DOMXPath;

class Index extends AbstractComponent
{

    public function __construct()
    {
        parent::__construct(__DIR__);
    }

    public function render(): void
    {
        $this->getHtml();
    }

    protected function getParams(): array
    {
        return [
            'name' => 'dolar',
            'label' => 'Dolar',
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
