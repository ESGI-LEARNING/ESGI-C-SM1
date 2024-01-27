<?php

namespace App\Mails;

use Core\Mailer\Mailer;

class CommentMail
{
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
}