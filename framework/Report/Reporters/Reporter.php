<?php

namespace Framework\Report;

use Framework\Report\IReport;
use Framework\Report\IReporter;

class Reporter implements IReport
{

    public static function generate(IReporter $reporter): string
    {
        return $reporter->generate();
    }

}
