<?php

namespace Core\Views;

use App\Models\Page;
use App\Models\User;
use Core\Auth\Auth;
use Core\Router\Request;
use Core\Session\FlashService;

class HelperView
{
    public function hasRole(string $roleCheck): ?bool
    {
        $role = User::query()
            ->select(['user.id', 'user.email', 'role.name'])
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->where('role.name', '=', $roleCheck)
            ->andWhere('user.id', '=', Auth::id())
            ->get();
        $role = $role[0]->name ?? null;

        return Auth::check() && $roleCheck === $role;
    }

    public function flash(): array
    {
        $service = new FlashService();
        $service->getFlash('success');

        if (!empty($service->getMessage())) {
            return $service->getMessage();
        }

        return [];
    }

    public function rootIs(string $path): bool
    {
        return (new Request())->getUrl() === $path;
    }

    public function meta(): ?Page
    {
        $page = new Page();
        $page = $page::query()->where(
            'slug', '=', (new Request())->getUrl())
            ->get();

        return $page[0] ?? null;
    }
}
