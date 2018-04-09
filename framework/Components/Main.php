<?php

namespace Framework\Components;

use Framework\Components\ResolverComponent;
use Symfony\Component\Yaml\Yaml;

class Main
{

    public static function run(string $table): string
    {
        $html = '';
        $YML = Yaml::parseFile(__DIR__.'/../../config/pages/'.$table.'.yml');
        foreach ($YML['register']['type'] as $value) {
            $html .= ResolverComponent::resolve($value);
        }

        return $html;
    }

}
