<?php

namespace Core\DB;

class DB
{
    protected ?object $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO(dsn: 'mysql:host='.config('database.host').';dbname='.config('database.database').';charset=utf8', username: config('database.username'), password: config('database.password'));
        } catch (\PDOException $e) {
            echo 'Erreur SQL : '.$e->getMessage();
        }
    }

    public function getPdo(): ?object
    {
        return $this->pdo;
    }
}
