<?php

namespace Core\Controller;

use App\Models\User;
use Core\Auth\Authenticator;
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

    public function getUser(): ?User
    {
        return (new Authenticator())->getUser();
    }
}
