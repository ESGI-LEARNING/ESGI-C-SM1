<?php

namespace Core\DB\Relation;

use Core\DB\Model;

class Relation
{
    public function __construct(
        protected Model|array $result,
        protected string      $relationName
    )
    {
    }

    public function getDatas(): Model|array
    {
        if ($this->result instanceof Model) {
            $relation = $this->result->{$this->relationName}();
        } else {
            $relation = $this->result[0]->{$this->relationName}();
        }

        $model = $relation->getModel();

        if ($relation instanceof BelongToMany) {
            $primaryKey = $this->getPrimaryKey();
        } else {
            $primaryKey = $this->getPrimaryKey($relation->getLocalKey());
        }

        $foreignKeyValue = $this->getFk($relation->getForeignKey());

        if ($this->result instanceof Model) {
            if ($relation instanceof HasOne) {
                $this->result->relations[$this->relationName] = $model::findBy([$relation->getLocalKey() =>  $this->result->$foreignKeyValue()]);
            }

            if ($relation instanceof HasMany) {
                $this->result->relations[$this->relationName] = $model::query()
                    ->where($relation->getForeignKey(), '=',  $this->result->$primaryKey())
                    ->get();
            }

            if ($relation instanceof BelongToMany) {
                $this->result->relations[$this->relationName] = $model::query()
                    ->select([$this->getTableName($model) . '.*'])
                    ->join($relation->getPivot(), $relation->getPivot() . '.' . $relation->getOtherKey(), '=', $this->getTableName($model) . '.id')
                    ->where($relation->getPivot() . '.' . $relation->getForeignKey(), '=',  $this->result->$primaryKey())
                    ->get();
            }

            return $this->result;
        }

        // return array
        foreach ($this->result as $key => $result) {
            if ($relation instanceof HasOne) {
                $this->result[$key]->relations[$this->relationName] = $model::findBy([$relation->getLocalKey() => $this->result[$key]->$foreignKeyValue()]);
            }

            if ($relation instanceof HasMany) {
                $this->result[$key]->relations[$this->relationName] = $model::query()
                    ->where($relation->getForeignKey(), '=', $this->result[$key]->$primaryKey())
                    ->get();
            }

            if ($relation instanceof BelongToMany) {
                $this->result[$key]->relations[$this->relationName] = $model::query()
                    ->select([$this->getTableName($model) . '.*'])
                    ->join($relation->getPivot(), $relation->getPivot() . '.' . $relation->getOtherKey(), '=', $this->getTableName($model) . '.id')
                    ->where($relation->getPivot() . '.' . $relation->getForeignKey(), '=', $this->result[$key]->$primaryKey())
                    ->get();
            }
        }

        return $this->result;
    }

    public function getTableName(mixed $model): string
    {
        $tableName = (new $model())->getTableName();

        return str_replace(config('database.prefix') . '_', '', $tableName);
    }

    private function getPrimaryKey(string $key = null): string
    {
        if ($key) {
            return 'get' . ucfirst($key);
        }

        return 'getId';
    }

    private function getFk(string $key = null): string
    {
        if ($key) {
            $key = explode('_', $key);
            return 'get' . ucwords(strtolower($key[0])) . ucwords(strtolower($key[1]));
        }

        return 'getId';
    }
}
