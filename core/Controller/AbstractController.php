<?php

namespace Core\Controller;

use Core\Session\FlashSession;
use Core\Views\View;

class AbstractController extends FlashSession
{
    public function redirect(string $url): void
    {
        header('Location: '.$url);
        exit;
    }

    public function render(string $view, string $template, array $data = []): View
    {
        return new View($view, $template, $data);
    }
}
