<?php

namespace Framework\Components;

use App\Components\Input\Index as Input;
use App\Components\Textarea\Index as Textarea;
use App\Components\Email\Index as Email;
use App\Components\Password\Index as Password;
use App\Components\Dolar\Index as Dolar;

abstract class ResolverComponent
{
    private const COMPONENTS_ENABLED = [
        "input" => Input::class,
        "textarea" => Textarea::class,
        "email" => Email::class,
        "password" => Password::class,
        "dolar" => Dolar::class,
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

    public static function resolve(string $type): string
    {
        $class = self::COMPONENTS_ENABLED[$type];
        $component = new $class();
        return $component->render();
    }
}
