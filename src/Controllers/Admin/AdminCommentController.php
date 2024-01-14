<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminCommentController extends AbstractController
{
    public function index(): View
    {
        $comments = new Comment();
        $comments = $comments->findAll();
        return $this->render('admin/comments/index', 'back', [
            'comments' => $comments,
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
    
    
    
}
