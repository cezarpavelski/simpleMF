<?php

namespace Test\Framework\Translation;

use Test\BaseTestCase;
use Framework\Translation\Translator;

class TranslatorTest extends BaseTestCase
{
    public function testSetLocale(): void
    {
        Translator::setLocale('pt_BR');
        $this->assertEquals('pt_BR', Translator::getLocale());

        Translator::setLocale('en_US');
        $this->assertEquals('en_US', Translator::getLocale());
    }

}
