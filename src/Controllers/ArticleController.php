<?php

namespace App\Controllers;

use App\Models\Picture;
use App\Models\Comment;
use App\Models\User;
use Core\Controller\AbstractController;
use Core\Views\View;
use Core\Auth\Auth;
use App\Mails\CommentMail;
use App\Form\Commentaire\CommentEditType;

class ArticleController extends AbstractController
{
    public function article(string $slug): View
    {
        $article = Picture::query()
            ->with(['images', 'comments', 'user'])
            ->getOneBy(['slug' => $slug]);

        
        return $this->render('main/article', 'front', [
            'article' => $article
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
                'picture_id' => $pictureId,
            ];

            $commentModel = new Comment();
            $queryBuilder = $commentModel->query();
            $savedComment = $queryBuilder->save($comment, $commentModel);



            $this->addFlash('success', 'Commentaire ajouté avec succès!');
        } else {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un commentaire.');
        }

        $this->previous();
    }

    public function reportComment(int $commentId)
    {

        if ($this->verifyCsrfToken()) {

            $comment = Comment::find($commentId);
    
            if ($comment) {

                $comment->setIsReported(true);
                $comment->save();
    
                $adminUsers = User::query()
                    ->join('user_role', 'user.id', '=', 'user_role.user_id')
                    ->join('role', 'user_role.role_id', '=', 'role.id')
                    ->where('role.name', '=', 'ROLE_ADMIN')
                    ->get();

                    $userReported = User::find($comment->user_id);
                    $userReporter = User::find(Auth::id());
                    
                    $data = [
                        'comment_id' => $comment->getId(),
                        'content' => $comment->getContent(),
                    ];
                    
                    $mail = new CommentMail();
                    
                    $mail->sendReportCommentToUserReported($userReported->getEmail(), $data);
                    $mail->sendReportCommentToUserReporter($userReporter->getEmail(), $data);

                    foreach ($adminUsers as $admin) {
                        $mail->sendReportComment($admin->getEmail(), $data);
                    }
    
                $picture = Picture::query()
                    ->join('picture_comment', 'picture_comment.picture_id', '=', 'picture.id')
                    ->where('picture_comment.comment_id', '=', $commentId)
                    ->get()[0];
    
                if ($picture) {
                    $this->addFlash('success', 'Le commentaire a été signalé avec succès.');
                    $this->redirect->previous();
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
                    ->get()[0];
    
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
    public function editComment(int $commentId): View
    {
        $comment = Comment::find($commentId);
    
        if (!$comment) {
            $this->addFlash('error', 'Le commentaire que vous essayez de modifier n\'existe pas.');
            $this->redirect->previous();
        }
    
        $form = new CommentEditType($comment);  
        $form->handleRequest();
    
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setContent($form->get('content'));
            $comment->save();
    
            $this->addFlash('success', 'Le commentaire a bien été modifié');
            $this->redirect->previous();
        }
    
        return $this->render('main/comments/edit', 'front', [
            'comment' => $comment,
            'form' => $form->getConfig(),
        ]);
    }
    
}
