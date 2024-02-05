<?php

namespace App\Controllers;

use App\Models\Picture;
use Core\Controller\AbstractController;
use Core\Views\View;
use App\Models\User;
use GuzzleHttp\Psr7\Query;

class ArticleController extends AbstractController
{
    public function article(string $name): View
    {
        $article = Picture::query()
            ->select(['picture.*', 'user.username'])
            ->join('user', 'picture.user_id', '=', 'user.id')
            ->where('picture.name', '=', $name)
            ->get()[0]; // Récupérer le premier élément du tableau

        $articleImage = "/imes/{$article->image}";

        $images = Picture::query()
            ->findAll();

        $articleImageOnly = array_filter($images, function($image) use ($article) {
            return $image->id === $article->id;
        });


        return $this->render('main/article', 'front', [
            'article' => $article,
            'images' => $articleImageOnly, // Passer seulement l'image associée à l'article à la vue
        ]);
    }

}
