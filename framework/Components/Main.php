<?php

namespace Framework\Components;

use Framework\Facades\Request;
use Symfony\Component\Yaml\Yaml;

class Main
{

    public static function render(string $table): string
    {
        $html = '';
        foreach (self::getFields($table) as $value) {
            $html .= ResolverComponent::resolve($value)->render();
        }

        return $html;
    }

    public static function executeExtraAction(string $table): void
    {
		foreach (self::getFields($table) as $value) {
            $component = ResolverComponent::resolve($value);
            $component->executeExtraAction([
            	'file' => [
            		'file' => Request::files('image')
				]
			]);
        }
    }

    public static function getFields(string $table): array
	{
		$YML = Yaml::parseFile(__DIR__.'/../../config/pages/'.$table.'.yml');
		return $YML['register'];
	}

	public static function getTitle(string $table): string
	{
		$YML = Yaml::parseFile(__DIR__.'/../../config/pages/'.$table.'.yml');
		return $YML['title'];
	}

}
