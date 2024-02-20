<?php

namespace App\Controllers;

use App\Models\Page;
use Core\Controller\AbstractController;
use Core\Views\View;

class ArticleController extends AbstractController
{
    public function article(): View
    {
        return $this->render('main/article', 'front');
    }
}
