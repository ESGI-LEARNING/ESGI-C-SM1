<?php

namespace Core\DB\QueryBuilder;

use Core\Auth\Auth;
use Core\DB\DB;
use Core\DB\Pagination\Pagination;
use Core\DB\Relation\Relation;

class QueryBuilder extends DB
{
    private array $whereCondition = [];
    private array $joins          = [];
    private array $orderBy        = [];
    private array $columns        = [];
    private array $limit          = [];
    private array $with           = [];

    public function __construct(
        private readonly string $table,
        private readonly string $model,
        private readonly mixed $entity
    ) {
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

    public function limit(int $limit, int $offset): QueryBuilder
    {
        $this->limit = [$limit, $offset];

        return $this;
    }

    public function where(string $column, string $operator, mixed $parameter): QueryBuilder
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), $operator, $parameter,
        ];

        return $this;
    }

    public function andWhere(string $column, string $operator, mixed $parameter): QueryBuilder
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), $operator, $parameter,
        ];

        return $this;
    }

    public function whereIn(string $column, array $values): QueryBuilder
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), 'IN', $values,
        ];

        return $this;
    }

    public function join(string $table, string $pk, string $operator, string $fk): QueryBuilder
    {
        $table = $this->getPrefix().$table;
        $fk    = $this->getPrefix().$fk;
        $pk    = $this->getPrefix().$pk;

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

        $sql .= ' FROM '.$this->table;

        if (!empty($this->joins)) {
            $sql .= ' '.implode(' ', $this->joins);
        }

        if (!empty($this->whereCondition)) {
            $sql .= ' WHERE';

            foreach ($this->whereCondition as $condition) {
                $p = str_replace('.', '_', $condition[0]);

                $sql .= ' '.$condition[0].$condition[1].':'.$p.' AND';
                $where[$p] = $condition[2];
            }

            $sql = substr($sql, 0, -3);
        }

        if (!empty($this->orderBy)) {
            $sql .= ' '.implode(' ', $this->orderBy);
        }

        if (!empty($this->limit)) {
            $sql .= ' LIMIT '.implode(',', $this->limit);
        }

        $query = $this->pdo->prepare($sql);
        $query->execute($where);

        $result = $query->fetchAll(\PDO::FETCH_CLASS, $this->model);

        if (!empty($result) && !empty($this->with)) {
            foreach ($this->with as $relation) {
                if (method_exists($this->model, $relation)) {
                    $result = (new Relation($result, $relation))->getDatas();
                }
            }
        }

        return $result;
    }

    public function count(): int
    {
        $sql   = 'SELECT COUNT(*) FROM '.$this->table;
        $query = $this->execute($sql);

        return $query->fetchColumn();
    }

    public function findAll(): array
    {
        if (method_exists($this->entity, 'getIsDeleted')) {
            $sql        = 'SELECT * FROM `'.$this->table.'` WHERE is_deleted =:is_deleted';
            $parameters = ['is_deleted' => 0];
        } else {
            $sql        = 'SELECT * FROM `'.$this->table.'`';
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
        $sql = 'DELETE FROM `'.$this->table.'` WHERE id = :id';

        $this->addLogs('delete');

        return $this->execute($sql, [
            'id' => $id,
        ]);
    }

    public function getOneBy(array $data)
    {
        $sql = 'SELECT * FROM `'.$this->table.'` WHERE ';

        foreach ($data as $column => $value) {
            $sql .= ' '.$column.'=:'.$column.' AND';
        }

        $sql   = substr($sql, 0, -3);
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->model);

        $result = $query->fetch();

        if (!empty($result) && !empty($this->with)) {
            foreach ($this->with as $relation) {
                if (method_exists($this->model, $relation)) {
                    // mettre ne place la recursivite entre les relations 
                    $result = (new Relation($result, $relation))->getDatas();
                }
            }
        }

        return $result === false ? null : $result;
    }

    public function paginate(int $perPage = 10, int $page = 1): Pagination
    {
        if ($page === 0) {
            $page = 1;
        }

        $total = $this->count();
        $pages = ceil($total / $perPage);

        $offset = $page === 0 ? 1 : ($page - 1) * $perPage;

        $this->limit($offset, $perPage);
        $result = $this->get();

        $links = [
            'total'        => $total,
            'perPage'      => $perPage,
            'total_pages'  => $pages,
            'current_page' => $page,
        ];

        return new Pagination($result, $links);
    }

    public function save(array $data, mixed $entity)
    {
        if (empty($entity->getId())) {
            $sql = 'INSERT INTO `'.$this->table.'`('.implode(',', array_keys($data)).') 
            VALUES (:'.implode(',:', array_keys($data)).')';

            $query = $this->pdo->prepare($sql);
            $query->execute($data);
            $entity->setId($this->pdo->lastInsertId());

            $this->addLogs('create');
        } else {
            $sql = 'UPDATE '.$this->table.' SET ';

            foreach ($data as $column => $value) {
                $sql .= $column.'=:'.$column.',';
            }

            $sql = rtrim($sql, ',');
            $sql .= ' WHERE id = :id';
            $data['id'] = $entity->getId();

            $query = $this->pdo->prepare($sql);
            $query->execute($data);

            $this->addLogs('update');
        }

        return $entity;
    }

    private function setPrefixIfDot(string $column): string
    {
        if (str_contains($column, '.')) {
            return $this->getPrefix().$column;
        }

        return $column;
    }

    private function addLogs(string $action): void
    {
        $prefix = config('database.prefix').'_';
        $sql    = "INSERT INTO `{$prefix}log` (user_id, action, subject, created_at) VALUES (:user_id, :action, :subject, :created_at)";

        $query = $this->pdo->prepare($sql);

        $query->execute([
            'user_id'    => Auth::check() ? Auth::id() : null,
            'action'     => $action,
            'subject'    => $this->table.' '.$this->entity->getId(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
