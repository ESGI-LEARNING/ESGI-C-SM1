<?php

namespace Core\DB;

class DB
{
    protected ?object $pdo = null;
    private ?string $error = null;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO(dsn: 'mysql:host='.config('database.host').';dbname='.config('database.database').';charset=utf8', username: config('database.username'), password: config('database.password'));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
           $this->error = $e->getMessage();
        }
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getPdo(): ?object
    {
        return $this->pdo;
    }

    protected function getPrefix(): string
    {
        return config('database.prefix') . '_';
    }
}
