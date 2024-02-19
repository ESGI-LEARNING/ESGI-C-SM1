<?php

namespace App\Mails;

use Core\Mailer\Mailer;

class CommentMail
{
    //mail pour l'admin
    public function sendReportComment(string $email, array $data): void
    {
        $mail = new Mailer();
        $mail->send(
            $email,
            'Signalement d\'un commentaire',
            'comment/report-comment',
            'comment/report-comment',
            $data
        );
    }

    public function sendReportCommentToUserReported(string $email, array $data): void
    {
        $mail = new Mailer();
        $mail->send(
            $email,
            'Votre commentaire a été signalé',
            'comment/report-comment-to-user',
            'comment/report-comment-to-user',
            $data
        );
    }

    public function sendReportCommentToUserReporter(string $email, array $data): void
    {
        $mail = new Mailer();
        $mail->send(
            $email,
            'Votre signalement a bien été pris en compte',
            'comment/report-comment-to-user-reporter',
            'comment/report-comment-to-user-reporter',
            $data
        );
    }
}