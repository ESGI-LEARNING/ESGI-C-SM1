<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class ErrorController extends AbstractController
{
    public function page404(): View
    {
        return $this->render('error/404', 'front');
    }
}
