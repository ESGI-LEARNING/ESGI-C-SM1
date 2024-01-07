<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class AboutUsController extends AbstractController
{
    public function aboutUs(): View
    {
        return $this->render('main/aboutUs', 'front');
    }
}
