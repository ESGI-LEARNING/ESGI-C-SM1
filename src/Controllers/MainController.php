<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class MainController extends AbstractController
{
    public function home(): View
    {
        return $this->render('main/home', 'front');
    }

    public function artist(): View
    {
        return $this->render('main/artist', 'front');
    }

    public function template(): View
    {
        return $this->render('main/template', 'front');
    }
}
