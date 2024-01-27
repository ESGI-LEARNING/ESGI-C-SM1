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
    
        return $this->render('admin/comments/index', 'back', [
            'comments' => Comment::findAll(),
        ]);
    }

    public function delete(int $id): void
    {
        $comment = Comment::find($id);
    
        if ($comment) {
            $comment->setIsDeleted(true);
            $comment->save();
    
            $this->addFlash('success', 'Le commentaire a bien été supprimé');
            $this->redirect('/admin/comments');
        }
    }
    public function report(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setIsReported(true);
            $comment->save();

            // Envoyer un mail à l'admin
            $mail = new CommentMail();
            $mail->sendReportComment('quentinandrieu@yahoo.com', [
                'comment_id' => $comment->getId(),
                'content' => $comment->getContent(),
            ]);

            $this->addFlash('success', 'Le commentaire a été signalé avec succès.');
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }
    public function keep(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setIsReported(false); // Marquer comme non signalé
            $comment->save();

            $this->addFlash('success', 'Le commentaire a été gardé.');
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }
}
