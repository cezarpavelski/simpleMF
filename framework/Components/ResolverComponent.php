<?php

namespace Framework\Components;

use Framework\Components\AbstractComponent;
use App\Components\Input\Index as Input;
use App\Components\Textarea\Index as Textarea;
use App\Components\Email\Index as Email;
use App\Components\Password\Index as Password;
use App\Components\Dolar\Index as Dolar;
use App\Components\Image\Index as Image;

abstract class ResolverComponent
{
    private const COMPONENTS_ENABLED = [
        "input" => Input::class,
        "textarea" => Textarea::class,
        "email" => Email::class,
        "password" => Password::class,
        "dolar" => Dolar::class,
        "image" => Image::class,
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

    public static function resolve(string $type): AbstractComponent
    {
        $class = self::COMPONENTS_ENABLED[$type];
        $component = new $class();
        return $component;
    }
}
