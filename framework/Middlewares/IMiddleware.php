<?php

namespace Framework\Middlewares;

interface IMiddleware
{
    public static function execute(): bool;

}
