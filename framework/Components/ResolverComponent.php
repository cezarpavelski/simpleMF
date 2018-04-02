<?php

namespace Framework\Components;

use App\Components\Input\Index as Input;
use App\Components\Textarea\Index as Textarea;

abstract class ResolverComponent
{
    private const COMPONENTS_ENABLED = [
        "input" => Input::class,
        "text" => Textarea::class,
        "calendar" => "",
        "date" => "",
        "phone" => "",
        "cpf" => "",
        "cnpj" => "",
        "hour" => "",
        "currency" => "",
        "cep" => "",
        "email" => "",
        "url" => "",
        "password" => "",
    ];

    public static function resolve(string $type): void
    {
        $class = self::COMPONENTS_ENABLED[$type];
        $component = new $class();
        $component->render();
    }
}
