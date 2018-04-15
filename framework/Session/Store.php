<?php

namespace Framework\Session;

class Store
{

    public static function set(string $key, string $params): void
    {
        $_SESSION[$key] = $params;
    }

    public static function get(string $key)
    {
        return !empty($_SESSION[$key]) ? $_SESSION[$key] : NULL;
    }

}
