<?php

use Core\Config\ConfigLoader;

function config(string $key): mixed
{
    return ConfigLoader::getInstance()->get($key);
}
