<?php

namespace Framework;

use Framework\Components\ResolverComponent;
use Framework\Database\ActiveRecord;

class Main
{

    public static function run(): void
    {
        $array = ['input','text'];
        foreach ($array as $value) {
            ResolverComponent::resolve($value);
        }
        self::test();
    }

    public function test()
    {
        $a = new ActiveRecord();
        $a->table = 'users';
        $a->params = [NULL,'ddddd','sdfdfdfsfsdf','asdfsdfsdf', date('Y-m-d H:i:s')];
        $a->insert();
    }
}
