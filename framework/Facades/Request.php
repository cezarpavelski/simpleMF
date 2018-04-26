<?php

namespace Framework\Facades;

class Request
{

    public static function get(string $key)
    {
        return !empty($_GET[$key]) ? $_GET[$key] : NULL;
    }

    public static function post(string $key)
    {
        return !empty($_POST[$key]) ? $_POST[$key] : NULL;
    }

}
