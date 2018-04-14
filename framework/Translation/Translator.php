<?php

namespace Framework\Translation;

use Framework\Session\Store as Session;

class Translator
{

    public static function setLocale(string $locale = 'pt_BR')
    {
        Session::set('lang', $locale);
        setlocale(LC_ALL, $locale);
    }

}
