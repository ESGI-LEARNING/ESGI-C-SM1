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
            $comment->setUpdatedAt(date('Y-m-d H:i:s'));
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

            $data = [
                'comment_id' => $comment->getId(),
                'content' => $comment->getContent(),
            ];

            $mail = new CommentMail();

            $mail->sendReportCommentToUserReported(User::find($comment->user_id)->getEmail(), $data);
            $mail->sendReportCommentToUserReporter( Auth::user()->getEmail(), $data);
            $mail->sendReportCommentToAdmins($data);
        }
    }
}