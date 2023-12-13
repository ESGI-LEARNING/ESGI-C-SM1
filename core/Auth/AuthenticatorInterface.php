<?php

namespace Core\Auth;

use App\Models\User;

interface AuthenticatorInterface
{
    public function login(User $user): void;

    public function logout(): void;
}