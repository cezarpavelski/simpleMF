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
        Broadcaster::publish('simple:login', ['username' => 'Guilhermao']);
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
