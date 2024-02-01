<?php

namespace Core\DB\Relation\Interfaces;

abstract class AbstractRelation
{
    public function __construct(
        protected string $model,
        protected ?string  $foreignKey = null,
        protected ?string $localKey = null
    )
    {
        if (is_null($this->foreignKey)) {
            $this->foreignKey = strtolower($this->model) . '_id';
        }

        if (is_null($this->localKey)) {
            $this->localKey = 'id';
        }
    }

    public function getForeignKey(): ?string
    {
        return $this->foreignKey;
    }

    public function getLocalKey(): ?string
    {
        return $this->localKey;
    }

    public function getModel(): string
    {
        return $this->model;
    }
}