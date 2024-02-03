<?php

namespace Core\Pagination;

class HttpRequest
{
    public static function getIntParam(string $paramName, int $defaultValue = 1): int
    {
        return isset($_GET[$paramName]) ? max(1, intval($_GET[$paramName])) : $defaultValue;
    }
}
