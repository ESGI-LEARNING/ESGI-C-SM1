<?php

namespace App\Controllers;

use App\Models\Picture;
use App\Models\Comment;
use App\Models\User;
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
            ->where('comment.is_deleted', '=', false)
            ->where('comment.is_reported', '=', false)
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

    public function reportComment(int $commentId)
    {
        // Verify CSRF token
        if ($this->verifyCsrfToken()) {
            // Find the comment by ID
            $comment = Comment::find($commentId);
    
            if ($comment) {

                $comment->setIsReported(true);
                $comment->save();
    
                // Fetch all admin users
                $adminUsers = User::query()
                    ->join('user_role', 'user.id', '=', 'user_role.user_id')
                    ->join('role', 'user_role.role_id', '=', 'role.id')
                    ->where('role.name', '=', 'ROLE_ADMIN')
                    ->get();
    
                // Send email to each admin user
                foreach ($adminUsers as $admin) {
                    $mail = new CommentMail();
                    $mail->sendReportComment($admin->getEmail(), [
                        'comment_id' => $comment->getId(),
                        'content'    => $comment->getContent(),
                    ]);
                }
    
                // Fetch the associated picture
                $picture = Picture::query()
                    ->join('picture_comment', 'picture_comment.picture_id', '=', 'picture.id')
                    ->where('picture_comment.comment_id', '=', $commentId)
                    ->first();
    
                if ($picture) {
                    $this->addFlash('success', 'Le commentaire a été signalé avec succès.');
                    $this->redirect("/article/{$picture->getSlug()}");
                } else {
                    $this->addFlash('error', 'L\'article associé à ce commentaire n\'a pas été trouvé.');
                }
            } else {
                $this->addFlash('error', 'Commentaire non trouvé.');
            }
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
        }
    
        $this->redirect('/');
    }
    
    public function deleteComment(int $commentId)
    {

        if (!Auth::check()) {
            $this->addFlash('error', 'Vous devez être connecté pour supprimer un commentaire.');
            $this->redirect("/");
        }
    
        // Verify CSRF token
        if ($this->verifyCsrfToken()) {

            $comment = Comment::find($commentId);
    
            if ($comment) {
                if ($comment->user_id !== Auth::id()) {
                    $this->addFlash('error', 'Vous n\'êtes pas autorisé à supprimer ce commentaire.');
                    $this->redirect("/gallery");
                }
    
                $comment->setIsDeleted(true);
                $comment->save();

                $picture = Picture::query()
                    ->join('picture_comment', 'picture_comment.picture_id', '=', 'picture.id')
                    ->where('picture_comment.comment_id', '=', $commentId)
                    ->first();
    
                if ($picture) {
                    $this->addFlash('success', 'Le commentaire a été supprimé avec succès.');
                    $this->redirect("/article/{$picture->getSlug()}");
                } else {
                    $this->addFlash('error', 'L\'article associé à ce commentaire n\'a pas été trouvé.');
                    $this->redirect("/gallery");
                }
            } else {
                $this->addFlash('error', 'Le commentaire que vous essayez de supprimer n\'existe pas.');
                $this->redirect("/gallery");
            }
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
            $this->redirect("/gallery");
        }
    }
    
}
