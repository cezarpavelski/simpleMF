<?php

namespace Framework;

use App\Components\ResolverComponent;

class Main
{

    public static function execute()
    {
        $array = ['input','text'];
        foreach ($array as $value) {
            ResolverComponent::resolve($value);
        }
    }
}
