<?php

namespace App\Mails;

use App\Models\User;
use Core\Auth\Auth;
use Core\Enum\Role;
use Core\Mailer\Mailer;

class ContactMail
{
    public function send(array $data): void
    {
        $mail = new Mailer();
        $emails = $this->getAdminsUsers();

        foreach ($emails as $email) {
            $mail->send(
                $email,
                'Email de contact',
                'contact/index',
                'contact/index',
                $data
            );
        }
    }

    private function getAdminsUsers(): array
    {
        return User::query()
            ->select(['user.emails'])
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where('role.name', '=', Role::ROLE_ADMIN)
            ->get();
    }
}