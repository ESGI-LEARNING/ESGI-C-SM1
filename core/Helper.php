<?php

use Core\Config\ConfigLoader;
use Core\Session\CsrfTokenService;

function config(string $key): mixed
{
    return ConfigLoader::getInstance()->get($key);
}

function url(string $url, ?array $params = []): string
{
    return config('app.url') . $url . '/' . implode('/', $params);
}

function assetLoader(): string
{
    $manifest = json_decode(file_get_contents(__DIR__.'/../public/build/manifest.json'), true);
    $css      = $manifest['assets/js/app.css']['file'];
    $js       = $manifest['assets/js/app.js']['file'];

    if (config('app.env') === 'dev') {
        return <<<HTML
            <script type="module" src="http://localhost:5173/assets/js/app.js"></script>
            <script type="module" src="http://localhost:5173/@vite/client"></script>
        HTML;
    }

    return <<<HTML
            <link rel="stylesheet" href="/build/{$css}">
            <script src="/build/{$js}"></script>
        HTML;
}
/** Pour le dev **/
function dd(mixed $var): void
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}