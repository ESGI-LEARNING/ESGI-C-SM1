<?php

namespace Core\DB\Migration;

use Core\DB\DB;

class BaseMigration
{
    private ?string $table = null;

    public function __construct(
        string $model = null
    ) {
        $this->table = $this->getTableName($model);
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getPrefix(): string
    {
        return config('database.prefix').'_';
    }

    public function execute(string $query): void
    {
        $pdo   = (new DB())->getPdo();
        $query = $pdo->prepare($query);
        $query->execute();
    }

    private function getTableName(string $model = null): ?string
    {
        if ($model) {
            $table = explode('\\', $model);
            $table = array_pop($table);

            $table = preg_replace('/(?<!^)([A-Z])/', '_$1', $table);

            return config('database.prefix').'_'.strtolower($table);
        }

        return null;
    }
}
