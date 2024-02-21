<?php

namespace App\Service;

use App\Mails\CommentMail;
use App\Models\Comment;
use App\Models\Picture;
use App\Models\User;
use Core\Auth\Auth;

class CommentService
{
    public static function comment(int $id): array
    {
        return Comment::query()
            ->with(['user'])
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
        $comment->setCreatedAt();
        $comment->setUpdatedAt();
        $comment->save();
    }

    public static function edit(int $id, string $content): void
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->setContent($content);
            $comment->setUpdatedAt();
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

            $reported = User::find($comment->getUserId());

            $data = [
                'comment_id' => $comment->getId(),
                'content'    => $comment->getContent(),
            ];

            $mail = new CommentMail();

            $mail->sendReportCommentToUserReported($reported->getEmail(), $data[] = ['username' => $reported->getUsername()]);
            $mail->sendReportCommentToUserReporter(Auth::user()->getEmail(), $data[] = ['username' =>  Auth::user()->getUsername()]);
            $mail->sendReportCommentToAdmins($data);
        }
    }
}
