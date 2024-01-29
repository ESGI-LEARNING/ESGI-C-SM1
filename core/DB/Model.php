<?php

namespace Core\DB;

class Model extends DB
{
    private string $table;
    private mixed $entity;

    private array $whereCondition = [];
    private array $joins = [];
    private array $orderBy = [];
    private array $columns = [];
    private array $limit = [];

    public function __construct(mixed $entity)
    {
        parent::__construct();
        $this->entity = $entity;
        $this->table = $this->getTableName();
    }

    public static function instance(): object
    {
        $class = get_called_class();

        return new $class();
    }

    public static function query(): Model
    {
        return self::instance();
    }

    public function select(array $columns): Model
    {
        $this->columns = array_map(function ($value) {
            return $this->setPrefixIfDot($value);
        }, $columns);

        return $this;
    }

    public function limit(int $limit): Model
    {
        $this->limit[] = $limit;

        return $this;
    }

    public function where(string $column, string $operator, mixed $parameter): Model
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), $operator, $parameter
        ];

        return $this;
    }

    public function andWhere(string $column, string $operator, mixed $parameter): Model
    {
        $this->whereCondition[] = [
            $this->setPrefixIfDot($column), $operator, $parameter
        ];

        return $this;
    }

    public function join(string $table, string $pk, string $operator, string $fk): Model
    {
        $table = $this->getPrefix() . $table;
        $fk = $this->getPrefix() . $fk;
        $pk = $this->getPrefix() . $pk;

        $this->joins[] = "LEFT JOIN $table ON $pk $operator $fk";

        return $this;
    }

    public function orderBy(string $column, string $order = 'ASC'): Model
    {
        $this->orderBy[] = "ORDER BY $column $order";

        return $this;
    }

    public function get(): false|array
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

        return $query->fetch();
    }

    public static function count(): int
    {
        $object = self::instance();

        $sql = 'SELECT COUNT(*) FROM ' . $object->table;
        $queryPrepared = $object->pdo->prepare($sql);
        $queryPrepared->execute();

        return $queryPrepared->fetchColumn();
    }

    public static function find(int $id): object
    {
        $object = self::instance();

        return $object->getOneBy(['id' => $id], 'object');
    }

    public static function findBy(array $data): object
    {
        $object = self::instance();

        return $object->getOneBy($data, 'object');
    }

    public static function findAll(): array
    {
        $object = self::instance();

        $sql = 'SELECT * FROM ' . $object->table . ' WHERE is_deleted = 0';

        $queryPrepared = $object->pdo->prepare($sql);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public function getOneBy(array $data, string $return = 'array')
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ';

        foreach ($data as $column => $value) {
            $sql .= ' ' . $column . '=:' . $column . ' AND';
        }

        $sql = substr($sql, 0, -3);

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($data);

        if ('object' == $return) {
            $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        }

        return $queryPrepared->fetch();
    }

    public function save(): void
    {
        $data = $this->getDataObject();

        if (empty($this->entity->getId())) {
            $sql = 'INSERT INTO ' . $this->table . '(' . implode(',', array_keys($data)) . ') 
            VALUES (:' . implode(',:', array_keys($data)) . ')';
        } else {
            $sql = 'UPDATE ' . $this->table . ' SET ';

            foreach ($data as $column => $value) {
                $sql .= $column . '=:' . $column . ',';
            }

            $sql = rtrim($sql, ',');
            $sql .= ' WHERE id = :id';
            $data['id'] = $this->entity->getId();
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($data);
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute(['id' => $this->entity->getId()]);
    }

    private function getDataObject(): array
    {
        return array_diff_key(get_object_vars($this), get_class_vars(get_class()));
    }

    private function getTableName(): string
    {
        $table = get_called_class();
        $table = explode('\\', $table);
        $table = array_pop($table);

        $table = preg_replace('/(?<!^)([A-Z])/', '_$1', $table);

        return $this->getPrefix() . strtolower($table);
    }

    private function getPrefix(): string
    {
        return config('database.prefix') . '_';
    }

    private function setPrefixIfDot(string $column): string
    {
        if (str_contains($column, '.')) {
            return $this->getPrefix() . $column;
        }

        return $column;
    }
}
