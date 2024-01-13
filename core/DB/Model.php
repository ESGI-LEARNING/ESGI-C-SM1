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
        $this->table  = $this->getTableName();
    }

    public static function instance(): object
    {
        $class  = get_called_class();
        return  new $class();
    }

    public function select(array $columns): object
    {
        $this->columns[] = $columns;
        return $this;
    }

    public function limit(int $limit): object
    {
        $this->limit[] = $limit;
        return $this;
    }

    public function where(array $data): object
    {
        $this->whereCondition = $data;
        return $this;
    }

    public function join(string $table, string $on): self
    {
        $this->joins[] = "JOIN $table ON $on";
        return $this;
    }

    public function orderBy(string $column, string $order = 'ASC'): self
    {
        $this->orderBy[] = "ORDER BY $column $order";
        return $this;
    }

    public static function get(): false|array
    {
        $object = self::instance();

        $sql = 'SELECT ';

        if (!empty($object->columns)) {
            $sql .= implode(',', $object->columns);
        } else {
            $sql .= '*';
        }

        $sql = ' FROM '.$object->table;

        if (!empty($object->joins)) {
            $sql .= ' '.implode(' ', $object->joins);
        }

        if (!empty($object->whereCondition)) {
            $sql .= ' WHERE ';

            foreach ($object->whereCondition as $column => $value) {
                $sql .= ' '.$column.'=:'.$column.' AND';
            }

            $sql = substr($sql, 0, -3);
        }

        if (!empty($object->orderBy)) {
            $sql .= ' '.implode(' ', $object->orderBy);
        }

        if (!empty($object->limit)) {
            $sql .= ' LIMIT '.implode(',', $object->limit);
        }

        $queryPrepared = $object->pdo->prepare($sql);
        $queryPrepared->execute($object->whereCondition);

        return $queryPrepared->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public static function count(): int
    {
        $object = self::instance();

        $sql = 'SELECT COUNT(*) FROM '.$object->table;
        $queryPrepared = $object->pdo->prepare($sql);
        $queryPrepared->execute();

        return $queryPrepared->fetchColumn();
    }

    public static function find(int $id): object
    {
        $object = self::instance();
        return $object->getOneBy(['id' => $id], 'object');
    }

    public static function finBy(array $data): object
    {
        $object = self::instance();
        return $object->getOneBy($data, 'object');
    }

    public static function findAll(): array
    {
        $object = self::instance();

        $sql = 'SELECT * FROM '. $object->table . ' WHERE is_deleted = 0';

        $queryPrepared = $object->pdo->prepare($sql);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    private function getOneBy(array $data, string $return = 'array')
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE ';

        foreach ($data as $column => $value) {
            $sql .= ' '.$column.'=:'.$column.' AND';
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
            $sql = 'INSERT INTO '.$this->table.'('.implode(',', array_keys($data)).') 
            VALUES (:'.implode(',:', array_keys($data)).')';
        } else {
            $sql = 'UPDATE '.$this->table.' SET ';

            foreach ($data as $column => $value) {
                $sql .= $column.'=:'.$column.',';
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

        return config('database.prefix'). '_' .strtolower($table);
    }
}
