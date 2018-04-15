<?php

namespace Test\Framework\Session;

use Test\BaseTestCase;
use Framework\Session\Store;

class TemplateTest extends BaseTestCase
{
    /**
    * @dataProvider providerSetValue
    */
    public function testSetSession($key, $value): void
    {
        Store::set($key, $value);
        $this->assertEquals($value, Store::get($key));
    }

    public function providerSetValue()
    {
        return [
            ['lang', 'pt_BR'],
            ['int', 1],
            ['name', 'Cezar']
        ];
    }

}
