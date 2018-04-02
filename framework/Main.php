<?php

namespace Framework;

use Framework\Components\ResolverComponent;
use Symfony\Component\Yaml\Yaml;

class Main
{

    public static function run(): void
    {
        $YML = Yaml::parseFile(__DIR__.'/../config/pages/page.example.yml');
        foreach ($YML['register']['type'] as $value) {
            ResolverComponent::resolve($value);
        }
    }

}
