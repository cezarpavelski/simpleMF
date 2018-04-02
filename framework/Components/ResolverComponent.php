<?php

namespace Framework\Components;

use App\Components\Input\Index as Input;
use App\Components\Textarea\Index as Textarea;
use App\Components\Email\Index as Email;
use App\Components\Password\Index as Password;

abstract class ResolverComponent
{
    private const COMPONENTS_ENABLED = [
        "input" => Input::class,
        "text" => Textarea::class,
        "email" => Email::class,
        "password" => Password::class,
        "calendar" => "",
        "date" => "",
        "phone" => "",
        "cpf" => "",
        "cnpj" => "",
        "hour" => "",
        "currency" => "",
        "cep" => "",
        "url" => "",
    ];

    public static function resolve(string $type): void
    {
        $class = self::COMPONENTS_ENABLED[$type];
        $component = new $class();
        $component->render();
    }
}
