<?php

namespace Core\DB;

class DB
{
    protected ?object $pdo = null;
    protected string $table;

    public function __construct(mixed $model = null)
    {
        // connexion à la bdd via pdo
        try {
            $this->pdo = new \PDO(dsn: 'mysql:host='.config('database.host').';dbname='.config('database.database').';charset=utf8', username: config('database.username'), password: config('database.password'));
        } catch (\PDOException $e) {
            echo 'Erreur SQL : '.$e->getMessage();
        }

        $table       = $model ?? get_called_class();
        $table       = explode('\\', $table);
        $table       = array_pop($table);
        $this->table = config('database.prefix').strtolower($table);
    }
}
