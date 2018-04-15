<?php

namespace Test\Framework\Template;

use Test\BaseTestCase;
use Framework\Templates\Template;

class TemplateTest extends BaseTestCase
{
    private $template;

    public function setUp(): void
    {
        $this->template = new Template(__DIR__.'/../../../views');
    }

    public function testRender(): void
    {
        $this->assertEquals($this->getExpectedHtml(), $this->template->render('http-errors/error_500.html'));
    }

    private function getExpectedHtml(): string
    {
        return file_get_contents(__DIR__.'/../../../views/http-errors/error_500.html');
    }

}
