<?php

namespace App\Controllers;

use App\Models\Page;
use Core\Controller\AbstractController;
use Core\Views\View;

class ArticleController extends AbstractController
{
    public function article(): View
    {
        $page = new Page();
        $page = $page::query()
            ->where('slug', '=', $_SERVER['REQUEST_URI'])
            ->get()[0];

        return $this->render('main/article', 'front', [
            'page' => $page,
        ]);
    }
}
