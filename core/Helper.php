<?php

use Core\Config\ConfigLoader;

function config(string $key): mixed
{
    return ConfigLoader::getInstance()->get($key);
}

function url(string $url, ?array $params = []): string
{
    return config('app.url') . $url . '/' . implode('/', $params);
}

/** Pour le dev **/
function dd(mixed $var): void
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}