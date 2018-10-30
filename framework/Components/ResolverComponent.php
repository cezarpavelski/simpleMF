<?php

namespace Framework\Components;

abstract class ResolverComponent
{
    private const COMPONENTS_ENABLED = [
        "input" => Input\Index::class,
        "textarea" => Textarea\Index::class,
        "email" => Email\Index::class,
        "password" => Password\Index::class,
        "dolar" => Dolar\Index::class,
        "image" => Image\Index::class,
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
