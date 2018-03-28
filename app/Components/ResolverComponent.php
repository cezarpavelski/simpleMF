<?php

namespace App\Components;

use App\Components\Input\Index as Input;
use App\Components\Textarea\Index as Textarea;

abstract class ResolverComponent
{
    public static function resolve($type)
    {

        switch ($type) {

            case "calendar":
                break;

            case "date":
                break;

            case "phone":
                break;

            case "cpf":
                break;

            case "cnpj":
                break;

            case "hour":
                break;

            case "currency":
                break;

            case "cep":
                break;

            case "email":
                break;

            case "url":
                break;

            case "input":
                $component = new Input();
                break;

            case "password":
                break;

            case "text":
                $component = new Textarea();
                break;

            case "archive":
                break;

            case "image":
                break;

            case "youtube":
                break;

            case "combobox":
                break;

            case "checkbox":
                break;

            case "radio":
                break;

            case "enum":
                break;

            default:
                $component = new Input();
                break;
        }

        $component->render();
    }
}
