<?php

namespace Framework\Translation;

use Framework\Session\Store as Session;

class Translator
{

    public static function setLocale(string $locale = 'pt_BR'): string
    {
        Session::set('lang', $locale);
        setlocale(LC_ALL, $locale);
        return $locale;
    }

    public static function getLocale(): ?string
    {
        return Session::get('lang');
    }

}
