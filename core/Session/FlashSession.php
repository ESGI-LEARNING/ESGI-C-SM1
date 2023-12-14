<?php

namespace Core\Session;

class FlashSession extends PHPSession
{
    public function success(string $message): void
    {
        $this->set('success', $message);
    }

    public function error(string $message): void
    {
        $this->set('error', $message);
    }

    public function warning(string $message): void
    {
        $this->set('warning', $message);
    }

    public function info(string $message): void
    {
        $this->set('info', $message);
    }
}
