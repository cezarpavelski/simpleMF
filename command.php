#!/usr/bin/php

<?php

require __DIR__ . '/vendor/autoload.php';

parse_str($argv[1]);

$class = '\App\Console\Commands\\'.$command.'Command';
$command = new $class();
$command->fire();

exit('done');