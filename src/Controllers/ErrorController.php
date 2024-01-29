<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class ErrorController extends AbstractController
{
    public function error(string $status): View
    {
        $template = 'errors/' . $status;
        return $this->render($template, 'front');
    }
}