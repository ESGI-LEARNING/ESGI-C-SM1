<?php

namespace Core\Controller;

use Core\Router\Router;
use Core\Session\FlashSession;
use Core\Views\View;

class AbstractController extends FlashSession
{
    public function redirect(string $name): void
    {
        Router::class->getInstance()->redirect($name);
    }

    public function render(string $view, string $template, array $params = []): View
    {
        return new View($view, $template, $params);
    }
}
