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
        $primaryKey = $this->getPrimaryKey($relation->getLocalKey());

        if ($this->result instanceof Model) {
            if ($relation instanceof HasOne) {
                $this->result->relations[$this->relationName] = $model::findBy([$relation->getLocalKey() => $this->result->$primaryKey()]);
            }

            if ($relation instanceof HasMany) {
                $this->result->relations[$this->relationName] = $model::query()
                    ->where($relation->getForeignKey(), '=', $this->result->$primaryKey())
                    ->get();
            }

            return $this->result;
        }

        // return array
        foreach ($this->result as $key => $result) {
            if ($relation instanceof HasOne) {
                $this->result[$key]->relations[$this->relationName] = $model::findBy([$relation->getLocalKey() => $result->$primaryKey()]);
            }

            if ($relation instanceof HasMany) {
                $this->result[$key]->relations[$this->relationName] = $model::query()
                    ->where($relation->getForeignKey(), '=', $result->$primaryKey())
                    ->get();
            }
        }

        return $this->result;
    }

    private function getPrimaryKey(string $key): string
    {
        return 'get' . ucfirst($key);
    }

}