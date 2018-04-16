<?php

namespace Framework\Report;

interface IReport
{
    public static function generate(IReporter $reporter): string;

}
