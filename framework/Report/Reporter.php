<?php

namespace Framework\Report;

use Framework\Report\IReporter;

class Reporter
{

    public static function generate(IReporter $reporter): string
    {
        return $reporter->generate();
    }

}
