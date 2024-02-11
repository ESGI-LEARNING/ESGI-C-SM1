<?php

namespace Core\Views;

use App\Models\User;
use Core\Auth\Auth;
use Core\Enum\Role;

class HelperView
{
    public function hasRole(string $role): bool
    {
        return Auth::check() && $this->getRole(roleCheck: $role) === $role;
    }

    public function getRole($roleCheck): ?string
    {
        $role = User::query()
            ->select(['user.id', 'user.email', 'role.name'])
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where('role.name', '=', $roleCheck)
            ->andWhere('user.id', '=', Auth::id())
            ->get();

        return $role[0]->name ?? null;
    }

    public function isAdministrator(): bool
    {
        return $this->hasRole(ROLE::ROLE_ADMIN);
    }

    public function isAuthor(): bool
    {
        return $this->hasRole(ROLE::ROLE_AUTHOR);
    }
}
