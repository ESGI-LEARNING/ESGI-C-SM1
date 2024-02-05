<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use App\Mails\CommentMail;
use Core\Controller\AbstractController;
use Core\Views\View;


class AdminCommentController extends AbstractController
{
    public function index(): View
    {
        $comments = Comment::query()
            ->with(['user'])
            ->paginate(10, intval($this->request()->get('page')));

        return $this->render('admin/comments/index', 'back', [
            'comments' => $comments,
        ]);
    }

    public function delete(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            if ($this->verifyCsrfToken()) { // Vérification du jeton CSRF
                $comment->setIsDeleted(true);
                $comment->save();

                $this->addFlash('success', 'Le commentaire a bien été supprimé');
                $this->redirect('/admin/comments');
            }
        }
    }

    public function report(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            if ($this->verifyCsrfToken()) { // Vérification du jeton CSRF
                $comment->setIsReported(true);
                $comment->save();

                // Envoyer un mail à l'admin
                $mail = new CommentMail();
                $mail->sendReportComment('quentinandrieu@yahoo.com', [
                    'comment_id' => $comment->getId(),
                    'content' => $comment->getContent(),
                ]);

                $this->addFlash('success', 'Le commentaire a été signalé avec succès.');
            }
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }

    public function keep(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            if ($this->verifyCsrfToken()) { // Vérification du jeton CSRF
                $comment->setIsReported(false); // Marquer comme non signalé
                $comment->save();

                $this->addFlash('success', 'Le commentaire a été gardé.');
            }
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }
}
