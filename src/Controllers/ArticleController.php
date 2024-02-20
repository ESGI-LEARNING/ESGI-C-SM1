<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class ArticleController extends AbstractController
{
    public function article(): View
    {
        return $this->render('main/article', 'front');
    }
}
