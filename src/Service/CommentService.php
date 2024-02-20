<?php

namespace App\Service;

use App\Models\Comment;
use App\Models\Picture;
use App\Models\User;
use Core\Auth\Auth;
use App\Mails\CommentMail;
use Core\Enum\Role;

class CommentService
{
    public static function comment(int $id): array
    {
        return Comment::query()
            ->where('picture_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public static function create(string $slug, string $content, int $userId): void
    {
        $picture = Picture::findBy(['slug' => $slug]);

        $comment = new Comment();
        $comment->setContent($content);
        $comment->setPictureId($picture->getId());
        $comment->setUserId($userId);
        $comment->save();
    }

    public static function edit(int $id, string $content): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setContent($content);
            $comment->save();
        }
    }

    public static function delete(int $id): void
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    public static function report(int $id): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setIsReported(1);
            $comment->save();

            $adminUsers = User::query()
                ->join('user_role', 'user.id', '=', 'user_role.user_id')
                ->join('role', 'user_role.role_id', '=', 'role.id')
                ->where('role.name', '=', Role::ROLE_ADMIN)
                ->get();

            $userReported = User::find($comment->user_id);
            $userReporter = Auth::user()->getEmail();

            $data = [
                'comment_id' => $comment->getId(),
                'content' => $comment->getContent(),
            ];

            $mail = new CommentMail();

            $mail->sendReportCommentToUserReported($userReported->getEmail(), $data);
            $mail->sendReportCommentToUserReporter($userReporter, $data);
            $mail->sendReportCommentToAdmins($adminUsers, $data);
        }
    }
}