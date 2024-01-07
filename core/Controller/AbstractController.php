<?php

namespace Core\Controller;

use Core\Session\FlashService;
use Core\Views\View;

class AbstractController
{
    public function redirect(string $name): void
    {
        header('Location: '.$name);
    }

    public function render(string $view, string $template, array $params = []): View
    {
        return new View($view, $template, $params);
    }

    public function addFlash(string $type, string $message): void
    {
        $flash = new FlashService();

        switch ($type) {
            case 'success':
                $flash->success($message);
                break;
            case 'error':
                $flash->error($message);
                break;
        }
    }

    public function envAsset(): string
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
}
