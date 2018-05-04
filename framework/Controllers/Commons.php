<?php

namespace Framework\Controllers;

use Framework\Controllers\BaseController;
use Framework\Broadcast\Broadcaster;
use Framework\Report\Reporters\CSVReporter;
use Framework\Report\Reporters\PDFReporter;
use Framework\Report\Reporter;
use Framework\Services\User as UserService;
use Framework\Translation\Translator;

class Commons extends BaseController
{

    public static function home(): void
    {
        $fmt = datefmt_create( "pt_BR" ,\IntlDateFormatter::MEDIUM, \IntlDateFormatter::MEDIUM);
        $fmt1 = datefmt_create( "en_US" ,\IntlDateFormatter::MEDIUM, \IntlDateFormatter::MEDIUM);
        $fmt2 = datefmt_create( "ru_RU" ,\IntlDateFormatter::MEDIUM, \IntlDateFormatter::MEDIUM);

        $fmtc1 = numfmt_create( "pt_BR" , \NumberFormatter::CURRENCY);
        $fmtc2 = numfmt_create( "en_US" , \NumberFormatter::CURRENCY);
        $fmtc3 = numfmt_create( "ru_RU" , \NumberFormatter::CURRENCY);

        $fmtd1 = numfmt_create( "pt_BR" , \NumberFormatter::DECIMAL);
        $fmtd2 = numfmt_create( "en_US" , \NumberFormatter::DECIMAL);
        $fmtd3 = numfmt_create( "ru_RU" , \NumberFormatter::DECIMAL);

        $plural1 = msgfmt_format_message('en_US', 'Peter has {0, plural, =0{no apple} =1{a apple} other{# apples}}', [0]);
        $plural2 = msgfmt_format_message('en_US', 'Peter has {0, plural, =0{no apple} =1{a apple} other{# apples}}', [1]);
        $plural3 = msgfmt_format_message('en_US', 'Peter has {0, plural, =0{no apple} =1{a apple} other{# apples}}', [2]);

        echo self::render('home/main.html', [
            'date1' => datefmt_format( $fmt , new \Datetime()),
            'date2' => datefmt_format( $fmt1 , new \Datetime()),
            'date3' => datefmt_format( $fmt2 , new \Datetime()),
            'currency1' => numfmt_format_currency($fmtc1, 3.56, "BRL"),
            'currency2' => numfmt_format_currency($fmtc2, 3.56, "USD"),
            'currency3' => numfmt_format_currency($fmtc3, 3.56, "RUB"),
            'decimal1' => numfmt_format($fmtd1, 5.56),
            'decimal2' => numfmt_format($fmtd2, 5.56),
            'decimal3' => numfmt_format($fmtd3, 5.56),
            'plural1' => $plural1,
            'plural2' => $plural2,
            'plural3' => $plural3,
        ]);
    }

    public static function socket(): void
    {
        Broadcaster::publish('simple:login', ['username' => 'Cezar']);
        echo self::render('home/main.html');
    }

    public static function import(): void
    {
        $users = UserService::import();
        echo self::render('users/main.html', ['users' => $users]);
    }

    public static function list(): void
    {
        $users = UserService::list();
        echo self::render('users/main.html', ['users' => $users]);
    }

    public static function scriptKey(): void
    {
        UserService::new();
        echo self::render('home/main.html');
    }

    public static function setLocale($lang): void
    {
        Translator::setLocale($lang);
        echo self::render('home/main.html', [
            'v' => 3.56,
            'count1' => 1,
            'count2' => 5,
            'date' => date('Y-m-d H:i:s')
        ]);
    }

    public static function sendMail($email): void
    {
        UserService::recoveryPassword($email);
        echo self::render('home/main.html');
    }

    public static function generatePDF(): void
    {
        $html = json_encode(UserService::list(), true);
        $pdf = new PDFReporter($html);
        echo Reporter::generate($pdf);
        exit;
    }

    public static function generateCSV(): void
    {

        foreach (UserService::list() as $user) {
            $array[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->password,
                $user->created_at
            ];
        }

        $csv = new CSVReporter(
            ['ID', 'Name', 'Email', 'Password', 'Created'],
            $array,
            true
        );
        echo Reporter::generate($csv);
        exit;
    }

}
