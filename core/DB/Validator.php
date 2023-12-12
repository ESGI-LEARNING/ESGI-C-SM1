<?php

namespace Core\DB;

class Validator
{
    private array $errors = [];

    public function __construct(
        private readonly array $data,
    )
    {
    }

    public function required(string ...$keys): self
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $this->data)) {
                $this->errors[$key] = 'Le champ '.$key.' est requis';
            }
        }

        return $this;
    }

    public function email(string ...$keys): self
    {
        foreach ($keys as $key) {
            if (!filter_var($this->data[$key], FILTER_VALIDATE_EMAIL)) {
                $this->errors[$key] = 'Le champ '.$key.' doit être un email valide';
            }
        }

        return $this;
    }

    public function min(int $min, string ...$keys): self
    {
        foreach ($keys as $key) {
            if (strlen($this->data[$key]) < $min) {
                $this->errors[$key] = 'Le champ '.$key.' doit contenir au moins '.$min.' caractères';
            }
        }

        return $this;
    }

    public function max(int $max, string ...$keys): self
    {
        foreach ($keys as $key) {
            if (strlen($this->data[$key]) > $max) {
                $this->errors[$key] = 'Le champ '.$key.' doit contenir au plus '.$max.' caractères';
            }
        }

        return $this;
    }

    public function unique(string $table, string ...$keys): self
    {
        foreach ($keys as $key) {
            $sql = 'SELECT * FROM '.$table.' WHERE '.$key.' = :'.$key;
            $queryPrepared = DB::getInstance()->getPDO()->prepare($sql);
            $queryPrepared->execute([$key => $this->data[$key]]);
            $result = $queryPrepared->fetch();

            if ($result) {
                $this->errors[$key] = 'Le champ '.$key.' doit être unique';
            }
        }

        return $this;
    }

    public function confirm(string $key, string $confirmKey): self
    {
        if ($this->data[$key] !== $this->data[$confirmKey]) {
            $this->errors[$key] = 'Le champ '.$key.' doit être identique au champ '.$confirmKey;
        }

        return $this;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}