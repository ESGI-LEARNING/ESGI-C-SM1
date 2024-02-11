<?php

namespace App\Controllers;

use App\Models\Picture;
use App\Models\Comment;
use Core\Controller\AbstractController;
use Core\Views\View;
use Core\Auth\Auth;
use App\Mails\CommentMail;

class ArticleController extends AbstractController
{
    public function article(string $name): View
    {
        $article = Picture::query()
            ->with(['image'])
            ->where('picture.name', '=', $name)
            ->get()[0];

        $comments = Comment::query()
            ->with(['user'])
            ->join('picture_comment', 'picture_comment.comment_id', '=', 'comment.id')
            ->where('picture_comment.picture_id', '=', $article->getId())
            ->orderBy('esgi_comment.created_at', 'DESC')
            ->paginate(10, (int)($this->request()->get('page')));
        
        return $this->render('main/article', 'front', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function addComment(int $pictureId)
    {
        $content = $_POST['comment'];

        // Vérifie si l'utilisateur est authentifié
        if (empty($content)) {
            $this->addFlash('error', 'Le commentaire ne peut pas être vide.');
            $this->redirect("/article/{$pictureId}");
        }
        if (Auth::check()) {
            $comment = [
                'content'    => $content,
                'user_id'    => Auth::id(),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            // Insertion du commentaire dans la base de données
            $commentModel = new Comment();
            $queryBuilder = $commentModel->query();
            $savedComment = $queryBuilder->save($comment, $commentModel);

            $picture = Picture::find($pictureId);
            $picture->comments()->attach($savedComment->getId());
            $picture->save();

            $this->addFlash('success', 'Commentaire ajouté avec succès!');
        } else {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un commentaire.');
        }

        $this->redirect("/article/{$picture->getSlug()}");
    }
}
