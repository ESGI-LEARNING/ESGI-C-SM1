<?php

use Core\Config\ConfigLoader;

function config(string $key): mixed
{
    return ConfigLoader::getInstance()->get($key);
}

function dd(mixed $var): void
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}
