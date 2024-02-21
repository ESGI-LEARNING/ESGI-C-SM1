<?php

namespace App\Controllers\Admin;

use App\Mails\CommentMail;
use App\Models\Comment;
use Core\Controller\AbstractController;
use Core\Pagination\Paginator;
use Core\Views\View;
use App\Models\User;
use Core\Enum\Role;


class AdminCommentController extends AbstractController
{
    public function index(): View
    {
        $comments = Comment::query()
            ->with(['user'])
            ->where('is_deleted', '=', false)
            ->paginate(10, (int) $this->request()->get('page'));

        return $this->render('admin/comments/index', 'back', [
            'comments' => $comments,
        ]);
    }

    public function delete(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            if ($this->verifyCsrfToken()) {
                $comment->setIsDeleted(1);
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
            if ($this->verifyCsrfToken()) {
                $comment->setIsReported(1);
                $comment->save();

                $adminUsers = User::query()
                ->join('user_role', 'user.id', '=', 'user_role.user_id')
                ->join('role', 'user_role.role_id', '=', 'role.id')
                ->where('role.name', '=', Role::ROLE_ADMIN)
                ->get();
                
                $data = [
                    'comment_id' => $comment->getId(),
                    'content' => $comment->getContent(),
                ];

                $mail = new CommentMail();

                $mail->sendReportCommentToAdmins($adminUsers, $data);

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
            if ($this->verifyCsrfToken()) {
                $comment->setIsReported(0);
                $comment->save();

                $this->addFlash('success', 'Le commentaire a été gardé.');
            }
        } else {
            $this->addFlash('error', 'Commentaire non trouvé.');
        }

        $this->redirect('/admin/comments');
    }
}
