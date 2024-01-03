<?php

namespace Core\Session;

interface SessionInterface
{
    /**
     * On récupère une valeur en session.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * On ajoute une valeur en session.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void;

    /**
     * On supprime une valeur en session.
     *
     * @param string $key
     * @return void
     */
    public function delete(string $key): void;
}
