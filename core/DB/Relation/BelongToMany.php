<?php

namespace Core\DB\Relation;

use Core\DB\DB;

class BelongToMany
{
    private \PDO $pdo;

    public function __construct(
        protected string $model,
        protected string $pivot,
        protected string $foreignKey,
        protected string $otherKey,
        protected int $idCurrentModel
    ) {
        $this->pdo = (new DB())->getPdo();
    }

    public function attach(int $id): void
    {
        $tableName = config('database.prefix') . '_' . $this->pivot;

        $sql = "INSERT INTO `{$tableName}` (`{$this->foreignKey}`, `{$this->otherKey}`) VALUES (:foreign_key, :other_id)";

        $query = $this->pdo->prepare($sql);
        $query->execute([
            'foreign_key' => $this->idCurrentModel,
            'other_id' => $id,
        ]);
    }

    public function sync(array $ids): void
    {
        $tableName = config('database.prefix').'_'.$this->pivot;

        $sql   = "DELETE FROM `{$tableName}` WHERE `{$this->foreignKey}` =:id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'id' => $this->idCurrentModel,
        ]);

        $sql = "INSERT INTO `{$tableName}` (`{$this->foreignKey}`, `{$this->otherKey}`) VALUES ";

        $placeholders = [];
        $values       = [];

        foreach ($ids as $id) {
            $placeholders[]              = "(:foreign_key{$id}, :other_id{$id})";
            $values[":foreign_key{$id}"] = $this->idCurrentModel;
            $values[":other_id{$id}"]    = $id;
        }

        $sql .= implode(', ', $placeholders);

        $query = $this->pdo->prepare($sql);
        $query->execute($values);
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getPivot(): string
    {
        return $this->pivot;
    }

    public function getForeignKey(): string
    {
        return $this->foreignKey;
    }

    public function getOtherKey(): string
    {
        return $this->otherKey;
    }
}
