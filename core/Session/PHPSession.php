<?php

namespace Core\Session;

class PHPSession implements SessionInterface
{
    public function get(string $key, mixed $default = null): mixed
    {
        $this->ensureStarted();

        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, mixed $value): void
    {
        $this->ensureStarted();
        $_SESSION[$key] = $value;
    }

    public function delete(string $key): void
    {
        $this->ensureStarted();
        unset($_SESSION[$key]);
    }

    /**
     * Vérifie si la session est démarrée.
     */
    private function ensureStarted(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            var_dump('session_start');
            session_start();
        }
    }
}
