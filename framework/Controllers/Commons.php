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
        echo self::render('home/main.html', [
            'v' => 3.56,
            'count1' => 1,
            'count2' => 5,
            'date' => date('Y-m-d H:i:s')
        ]);
    }

    public static function socket(): void
    {
        Broadcaster::publish('simple:login', ['username' => 'Cezar']);
        echo self::render('home/main.html');
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
        $html = "<div>Mestre dos Códigos ddd</div>";
        $pdf = new PDFReporter($html);
        echo Reporter::generate($pdf);
        exit;
    }

    public static function generateCSV(): void
    {
        $csv = new CSVReporter(
            ['ID', 'Name'],
            [
                [1, 'Cezar'],
                [2, 'Pavelski']
            ],
            true
        );
        echo Reporter::generate($csv);
        exit;
    }

}
