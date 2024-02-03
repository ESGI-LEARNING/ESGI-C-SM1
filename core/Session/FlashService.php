<?php

namespace Core\Session;

class FlashService extends PHPSession
{
    private const SESSION_KEY = 'flash';

    private array|null $message = null;

    public function success(string $message): void
    {
        $flash            = $this->get(self::SESSION_KEY, []);
        $flash['success'] = $message;
        $this->set(self::SESSION_KEY, $flash);
    }

    public function error(string $message): void
    {
        $flash          = $this->get(self::SESSION_KEY, []);
        $flash['error'] = $message;
        $this->set(self::SESSION_KEY, $flash);
    }

    public function getMessage(): array|null
    {
        var_dump($this->message);
        return $this->message;
    }

    public function getFlash(string $type): ?string
    {
        if ($this->message === null) {
            $this->message = $this->get(self::SESSION_KEY, []);
            $this->delete(self::SESSION_KEY);
        }

        if (array_key_exists($type, $this->message)) {
            return $this->message[$type];
        }

        return null;
    }
}
