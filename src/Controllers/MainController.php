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

    public function about(): View
    {
        return $this->render('main/artist', 'front');
    }

    public function contact(): View
    {
        return $this->render('main/contact', 'front');
    }
}
