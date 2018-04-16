<?php

namespace Framework\Report;

use Framework\Report\IReporter;

interface IReporter
{
    public function generate(): string;

}
