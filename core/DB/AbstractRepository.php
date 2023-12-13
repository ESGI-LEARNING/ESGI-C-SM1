<?php

namespace Core\DB;

class AbstractRepository extends DB
{
    public function getDataObject(): array
    {
        return array_diff_key(get_object_vars($this), get_class_vars(get_class()));
    }

    public static function find(int $id): object
    {
        $class  = get_called_class();
        $object = new $class();

        return $object->getOneBy(['id' => $id], 'object');
    }

    public function getOneBy(array $data, string $return = 'array')
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE ';

        foreach ($data as $column => $value) {
            $sql .= ' '.$column.'=:'.$column.' AND';
        }

        $sql           = substr($sql, 0, -3);

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

        if (empty($this->getId())) {

            $sql = 'INSERT INTO '.$this->table.'('.implode(',', array_keys($data)).') 
            VALUES (:'.implode(',:', array_keys($data)).')';

        } else {
            $sql = 'UPDATE '.$this->table.' SET ';

            foreach ($data as $column => $value) {
                $sql .= $column.'=:'.$column.',';
            }

            $sql = substr($sql, 0, -1);
            $sql .= ' WHERE id = '.$this->getId();
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($data);
    }
}