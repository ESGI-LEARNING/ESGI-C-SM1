<?php

namespace App\Mails;

use App\Models\User;
use Core\Enum\Role;
use Core\Mailer\Mailer;

class ContactMail
{
    public function send(array $data): void
    {
        $mail  = new Mailer();
        $users = $this->getAdminsUsers();

        foreach ($users as $user) {
            $mail->send(
                $user->email,
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
            ->select(['user.email'])
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where('role.name', '=', Role::ROLE_ADMIN)
            ->get();
    }
}
