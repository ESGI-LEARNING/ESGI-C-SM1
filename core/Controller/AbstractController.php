<?php

namespace Core\Controller;

use Core\Config\ConfigLoader;
use Core\Router\Request;
use Core\Session\CsrfTokenService;
use Core\Session\FlashService;
use Core\Views\View;

class AbstractController
{
    public function redirect(string $name): void
    {
        header('Location: '.$name);
    }

    public function previous(): void
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    public function verifyCsrfToken(): bool
    {
        $service = new CsrfTokenService();

        return $service->isValidCsrfToken($_REQUEST['csrf_token']);
    }

    public function render(string $view, string $template, array $params = []): View
    {
        return new View($view, $template, $params);
    }

    public function request(): Request
    {
        return new Request();
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

    public function setEnv(string $key, string $value): void
    {
        ConfigLoader::getInstance()->setEnv($key, $value);
    }
}
