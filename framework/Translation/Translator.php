<?php

namespace Framework\Translation;

class Translator
{

    public static function setLocale(string $locale = 'pt_BR')
    {
        $_SESSION['lang'] = $locale;
        setlocale(LC_ALL, $locale);
    }

}
