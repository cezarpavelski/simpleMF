<?php

date_default_timezone_set(getenv('TIMEZONE'));
ini_set('max_execution_time', 10 * 60);

require __DIR__ . '/../env.php';
require __DIR__ . '/../vendor/autoload.php';

use Framework\Templates\Template;
use Routes\Router;

ob_start();

header('Content-Type: text/html; charset=utf-8');

Router::run();
// $template = new Template(__DIR__.'/../views');
// echo $template->render('main.html', []);
// require __DIR__ . '/../public/main.php';

ob_end_flush();

exit;
