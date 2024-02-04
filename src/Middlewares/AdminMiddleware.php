<?php

namespace App\Middlewares;

use App\Models\User;
use Core\Auth\Auth;
use Core\Middleware\BaseMiddleware;

class AdminMiddleware extends BaseMiddleware
{
    public function __invoke(): void
    {
        $role = User::query()
            ->select(['user.id'])
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where('role.name', '=', 'ROLE_ADMIN')
            ->andWhere('user.id', '=', Auth::id())
            ->get();

        if (empty($role)) {
            $this->redirect('/errors/403');
        }
    }
}
