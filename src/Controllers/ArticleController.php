<?php

namespace App\Controllers;

use App\Models\Picture;
use App\Models\Comment;
use App\Models\User;
use App\Service\CommentService;
use Core\Controller\AbstractController;
use Core\Views\View;
use Core\Auth\Auth;
use App\Mails\CommentMail;
use App\Form\Commentaire\CommentEditType;

class ArticleController extends AbstractController
{
    public function index(string $slug): View
    {
        $article = Picture::query()
            ->with(['images', 'user'])
            ->getOneBy(['slug' => $slug]);

        return $this->render('main/article', 'front', [
            'article' => $article,
            'comments' => CommentService::comment($article->getId()),
        ]);
    }

    public function createComment(string $slug): void
    {
        if ($this->verifyCsrfToken()){
            CommentService::create($slug, $this->request()->getBody()['comment'], Auth::id());
            $this->addFlash('success', 'Le commentaire a bien été ajouté.');
            $this->redirect('/article/'.$slug);
        }
    }

    public function editComment(string $slug, int $id): void
    {
        if ($this->verifyCsrfToken()){
            CommentService::edit($id, $this->request()->getBody()['comment']);
            $this->addFlash('success', 'Le commentaire a bien été modifier.');
            $this->redirect('/article/'.$slug);
        }
    }

    public function reportComment(string $slug, int $id): void
    {
        if ($this->verifyCsrfToken()) {
            CommentService::report($id);
            $this->addFlash('success', 'Le commentaire a bien été signalé.');
            $this->redirect('/article/'.$slug);
        }
    }

    public function deleteComment(string $slug, int $id): void
    {
        if ($this->verifyCsrfToken()) {
            CommentService::delete($id);
            $this->addFlash('success', 'Le commentaire a bien été supprimé.');
            $this->redirect('/article/'.$slug);
        }
    }
}
