<?php

namespace App\Mails;

use Core\Mailer\Mailer;
use App\Models\Comment;
use App\Models\User;
use Core\Enum\Role;

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

    public function sendReportCommentToAdmins(array $data): void
    {
        foreach ($this->getAdmins() as $admin) {
            $this->sendReportComment($admin->getEmail(),  $data);
        }
    }

    private function getAdmins(): array
    {
        return User::query()
            ->select(['user.email'])
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where('role.name', '=', Role::ROLE_ADMIN)
            ->get();
    }
}
