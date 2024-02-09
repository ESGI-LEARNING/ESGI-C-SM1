<?php

namespace App\Controllers;

use App\Models\Picture;
use Core\Controller\AbstractController;
use Core\Views\View;
use App\Models\User;
use App\Models\Comment;
use GuzzleHttp\Psr7\Query;

class ArticleController extends AbstractController
{
    public function article(string $name): View
    {
        // Récupérer l'article
        $article = Picture::query()
            ->select(['picture.*', 'user.username'])
            ->join('user', 'picture.user_id', '=', 'user.id')
            ->where('picture.name', '=', $name)
            ->with(['image'])
            ->get()[0];

        return $this->render('main/article', 'front', [
            'article' => $article,
        ]);
    }

}
