<?php

namespace Framework\Translation;

use Framework\Session\Store as Session;
use Locale;

class Translator
{

    public static function setLocale(string $locale = 'pt_BR'): void
    {
        Session::set('lang', $locale);
        self::setLocaleIntl($locale);
    }

    public static function getLocale(): ?string
    {
        self::setLocaleIntl(Session::get('lang'));
        return Session::get('lang');
    }

    private function setLocaleIntl(?string $locale): void
    {
        if(!$locale) {
            $locale = getenv('LANGUAGE');
            Session::set('lang', $locale);
        }

        Locale::setDefault(str_replace( "_", "-", $locale));
    }

}
