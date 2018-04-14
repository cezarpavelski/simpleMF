<?php

namespace Framework\Session;

class Store
{

    public static function set(string $key, string $params)
    {
        $_SESSION[$key] = $params;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key];
    }

}
