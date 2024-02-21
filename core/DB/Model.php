<?php

namespace Core\DB;

use Core\DB\QueryBuilder\QueryBuilder;
use Core\DB\Relation\BelongToMany;
use Core\DB\Relation\HasMany;
use Core\DB\Relation\HasOne;

abstract class Model
{
    private mixed $entity;

    public array $relations = [];

    private QueryBuilder $queryBuilder;

    public function __construct(mixed $entity)
    {
        $this->entity       = $entity;
        $this->queryBuilder = new QueryBuilder($this->getTableName(), get_called_class(), $entity);
    }

    public function belongsToMany(string $model, string $pivot, string $foreignKey = null, string $otherKey = null): BelongToMany
    {
        return new BelongToMany($model, $pivot, $foreignKey, $otherKey, $this->entity->getId());
    }

    public function hasOne(string $model, string $foreignKey = null, string $localKey = null): HasOne
    {
        return new HasOne($model, $foreignKey, $localKey);
    }

    public function hasMany(string $model, string $foreignKey = null, string $localKey = null): HasMany
    {
        return new HasMany($model, $foreignKey, $localKey);
    }

    public static function query(): QueryBuilder
    {
        return (new static())->queryBuilder->query();
    }

    public static function count(): int
    {
        return (new static())->queryBuilder->count();
    }

    public static function find(int $id): static|null
    {
        return (new static())->queryBuilder->getOneBy(['id' => $id]);
    }

    public static function findBy(array $data): static|null
    {
        return (new static())->queryBuilder->getOneBy($data);
    }

    public static function findAll(): array
    {
        return (new static())->queryBuilder->findAll();
    }

    public function paginate(int $perPage = 15, int $page = 1): array
    {
        return $this->queryBuilder->paginate($perPage, $page);
    }

    public function save(): void
    {
        $data         = $this->getDataObject();
        $this->entity = $this->queryBuilder->save($data, $this->entity);
    }

    public function delete(): \PDOStatement|false
    {
        return $this->queryBuilder->delete($this->entity->getId());
    }

    public function softDelete(): void
    {
        $this->entity->setIsDeleted(1);
        $this->entity->setUpdatedAt();
        $this->entity->save();
    }

    public function hardDelete(): \PDOStatement|false
    {
        return $this->queryBuilder->hardDelete($this->entity->getId());
    }

    private function getDataObject(): array
    {
        return array_diff_key(get_object_vars($this), get_class_vars(get_class()));
    }

    public function getTableName(): string
    {
        $table = get_called_class();
        $table = explode('\\', $table);
        $table = array_pop($table);

        $table = preg_replace('/(?<!^)([A-Z])/', '_$1', $table);

        return config('database.prefix').'_'.strtolower($table);
    }

    public function __get(string $name)
    {
        if (isset($this->relations[$name])) {
            return $this->relations[$name];
        }

        return $this->entity->$name ?? null;
    }
}
