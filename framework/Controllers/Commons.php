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

    public static function home(): string
    {
        return self::render([
            'v' => 3.56,
            'count1' => 1,
            'count2' => 5,
            'date' => date('Y-m-d H:i:s')
        ], 'home/main.html');
    }

    public static function socket(): string
    {
        Broadcaster::publish('simple:login', ['username' => 'Guilhermao']);
        return self::render([], 'home/main.html');
    }

    public static function import(): string
    {
        $users = UserService::import();
        return self::render(['users' => $users], 'users/main.html');
    }

    public static function list(): string
    {
        $users = UserService::list();
        return self::render(['users' => $users], 'users/main.html');
    }

    public static function scriptKey(): string
    {
        UserService::new();
        return self::render([],'home/main.html');
    }

    public static function setLocale($lang): string
    {
        Translator::setLocale($lang);
        return self::render([
            'v' => 3.56,
            'count1' => 1,
            'count2' => 5,
            'date' => date('Y-m-d H:i:s')
        ], 'home/main.html');
    }

    public static function sendMail($email): string
    {
        UserService::recoveryPassword($email);
        return self::render([], 'home/main.html');
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
