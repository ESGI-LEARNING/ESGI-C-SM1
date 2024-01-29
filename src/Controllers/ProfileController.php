<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class ProfileController extends AbstractController
{
    public function index(): View
    {
        return $this->render('profile/index', 'front');
    }

}