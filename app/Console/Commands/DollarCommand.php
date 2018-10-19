<?php

namespace App\Console\Commands;

use Framework\Console\Commands\ICommand;

class DollarCommand implements ICommand
{
	public function fire(): void
	{
		$amount_dolar = $this->parseHtmlDolar();
		file_put_contents('/var/tmp/dollarhoje.txt', $amount_dolar."\n", FILE_APPEND);
	}

	private function parseHtmlDolar(): float
	{
		$html = $this->getHtmlDolar();
		$dom = new \DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($html);
		libxml_clear_errors();

		$xpath = new \DOMXPath($dom);
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