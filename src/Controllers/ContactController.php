<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class ContactController extends AbstractController
{
    public function contact(): View
    {
        return $this->render('main/contact', 'front');
    }
}
