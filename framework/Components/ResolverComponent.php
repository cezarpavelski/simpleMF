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
        "date" => Date\Index::class,
        "phone" => "",
        "cpf" => "",
        "cnpj" => "",
        "hour" => "",
        "currency" => "",
        "cep" => "",
        "url" => "",
    ];

    public static function resolve(array $config): AbstractComponent
    {
        $class = self::COMPONENTS_ENABLED[$config['type']];
        $component = new $class($config['field'], $config['label'], 0);
        return $component;
    }
}
