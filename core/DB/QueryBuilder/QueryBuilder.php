<?php

namespace Core\DB\QueryBuilder;

use Core\DB\DB;
use Core\DB\Model;
use Core\DB\Relation\Relation;

class QueryBuilder extends DB
{
    private array $whereCondition = [];
    private array $joins = [];
    private array $orderBy = [];
    private array $columns = [];
    private array $limit = [];
    private array $with = [];


    public function __construct(
        private readonly string $table,
        private readonly string $model
    )
    {
        parent::__construct();
    }

    public function execute(string $sql, array $parameters = []): false|\PDOStatement
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);

        return $query;
    }

    public function query(): QueryBuilder
    {
        return $this;
    }

    public function with(array $relations): QueryBuilder
    {
        $this->with = $relations;
        return $this;
    }

    public function select(array $columns): QueryBuilder
    {
        $this->columns = array_map(function ($value) {
            return $this->setPrefixIfDot($value);
        }, $columns);

        return $this;
    }

    public function limit(int $limit): QueryBuilder
    {
        $this->limit[] = $limit;

        return $this;
    }

    public function where(string $column, string $operator, mixed $parameter): QueryBuilder
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), $operator, $parameter
        ];

        return $this;
    }

    public function andWhere(string $column, string $operator, mixed $parameter): QueryBuilder
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), $operator, $parameter
        ];

        return $this;
    }

    public function whereIn(string $column, array $values): QueryBuilder
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), 'IN', $values
        ];

        return $this;
    }

    public function join(string $table, string $pk, string $operator, string $fk): QueryBuilder
    {
        $table = $this->getPrefix() . $table;
        $fk = $this->getPrefix() . $fk;
        $pk = $this->getPrefix() . $pk;

        $this->joins[] = "LEFT JOIN $table ON $pk $operator $fk";

        return $this;
    }

    public function orderBy(string $column, string $order = 'ASC'): QueryBuilder
    {
        $this->orderBy[] = "ORDER BY $column $order";

        return $this;
    }

    public function get(): array
    {
        $where = [];

        $sql = 'SELECT ';

        if (!empty($this->columns)) {
            $sql .= implode(',', $this->columns);
        } else {
            $sql .= '*';
        }

        $sql .= ' FROM ' . $this->table;

        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }

        if (!empty($this->whereCondition)) {
            $sql .= ' WHERE';

            foreach ($this->whereCondition as $condition) {
                $p = str_replace('.', '_', $condition[0]);

                $sql .= ' ' . $condition[0] . $condition[1] . ':' . $p . ' AND';
                $where[$p] = $condition[2];
            }

            $sql = substr($sql, 0, -3);
        }

        if (!empty($this->orderBy)) {
            $sql .= ' ' . implode(' ', $this->orderBy);
        }

        if (!empty($this->limit)) {
            $sql .= ' LIMIT ' . implode(',', $this->limit);
        }

        $query = $this->pdo->prepare($sql);
        $query->execute($where);

        return $query->fetchAll(\PDO::FETCH_CLASS, $this->model);
    }

    public function count(): int
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->table;
        $query = $this->execute($sql);
        return $query->fetchColumn();
    }

    public function findAll(mixed $model): array
    {
        if (method_exists($model, 'getIsDeleted')) {
            $sql = 'SELECT * FROM `' . $this->table . '` WHERE is_deleted =:is_deleted';
            $parameters = ['is_deleted' => 0,];
        } else {
            $sql = 'SELECT * FROM `' . $this->table . '`';
            $parameters = [];
        }

        $result = $this->execute($sql, $parameters)->fetchAll(\PDO::FETCH_CLASS, $this->model);


        if (!empty($result) && !empty($this->with)) {
            foreach ($this->with as $relation) {
                if (method_exists($this->model, $relation)) {
                    $result = (new Relation($result, $relation))->getDatas();
                }
            }
        }

        return $result;
    }

    public function delete(int $id): false|\PDOStatement
    {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE id = :id';

        return $this->execute($sql, [
            'id' => $id,
        ]);
    }

    public function getOneBy(array $data)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE ';

        foreach ($data as $column => $value) {
            $sql .= ' ' . $column . '=:' . $column . ' AND';
        }

        $sql = substr($sql, 0, -3);

        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->model);

        $result = $query->fetch();

        if (!empty($result) && !empty($this->with)) {
            foreach ($this->with as $relation) {
                if (method_exists($this->model, $relation)) {
                    $result = (new Relation($result, $relation))->getDatas();
                }
            }
        }

        return $result;
    }

    public function save(array $data, mixed $entity)
    {
        if (empty($entity->getId())) {
            $sql = 'INSERT INTO `' . $this->table . '`(' . implode(',', array_keys($data)) . ') 
            VALUES (:' . implode(',:', array_keys($data)) . ')';

            $query = $this->pdo->prepare($sql);
            $query->execute($data);
            $entity->setId($this->pdo->lastInsertId());
        } else {
            $sql = 'UPDATE ' . $this->table . ' SET ';

            foreach ($data as $column => $value) {
                $sql .= $column . '=:' . $column . ',';
            }

            $sql = rtrim($sql, ',');
            $sql .= ' WHERE id = :id';
            $data['id'] = $entity->getId();

            $query = $this->pdo->prepare($sql);
            $query->execute($data);
        }

        return $entity;
    }

    private function setPrefixIfDot(string $column): string
    {
        if (str_contains($column, '.')) {
            return $this->getPrefix() . $column;
        }

        return $column;
    }
}