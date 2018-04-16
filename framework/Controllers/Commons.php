<?php

namespace Framework\Controllers;

use Framework\Controllers\BaseController;
use Framework\Broadcast\Broadcaster;
use Framework\Report\Reporters\CSVReporter;
use Framework\Report\Reporters\PDFReporter;
use Framework\Report\Reporter;

class Commons extends BaseController
{

    public static function home(): void
    {
        Broadcaster::publish('simple:login', ['username' => 'Cezar']);
        echo self::render('home/main.html');
    }

    public static function generatePDF(): void
    {
        $html = self::render('home/main.html');
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
