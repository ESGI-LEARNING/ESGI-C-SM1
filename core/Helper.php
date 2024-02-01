<?php

use Core\Config\ConfigLoader;

function config(string $key): mixed
{
    return ConfigLoader::getInstance()->get($key);
}

function icon(string $iconName): string
{
    $iconPath = "../assets/images/icons/{$iconName}.svg";
    if (file_exists($iconPath)) {
        return file_get_contents($iconPath);
    }

    return '?';
}

function url(string $url, ?array $params = []): string
{
    return config('app.url').$url.'/'.implode('/', $params);
}

function slug(string $text): array|string|null
{
    $slug = str_replace(' ', '-', strtolower($text));

    return preg_replace('/[^\w\s-]/', '', $slug);
}

function assetLoader(): string
{
    $manifest = json_decode(file_get_contents(__DIR__.'/../public/build/.vite/manifest.json'), true);
    $css      = $manifest['assets/js/app.js']['css'][0];
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
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}
