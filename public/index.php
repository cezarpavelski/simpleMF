<?php

date_default_timezone_set(getenv('TIMEZONE'));
ini_set('max_execution_time', 10 * 60);

require __DIR__ . '/../env.php';
require __DIR__ . '/../vendor/autoload.php';
//require __DIR__ . '/../routes/routes.php';
require __DIR__ . '/../routes/Router.php';
//print_r($_REQUEST);

ob_start();

header('Content-Type: text/html; charset=utf-8');

// \Routes\Router::run();
require __DIR__ . '/../public/main.php';

ob_end_flush();

exit;
