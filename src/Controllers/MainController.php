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

    public function aboutUs(): View
    {
        return $this->render('main/aboutUs', 'front');
    }

    public function contact(): View
    {
        return $this->render('main/contact', 'front');
    }

    public function gallery(): View
    {
        return $this->render('main/gallery', 'front');
    }

    public function artist(): View
    {
        return $this->render('main/artist', 'front');
    }
}
