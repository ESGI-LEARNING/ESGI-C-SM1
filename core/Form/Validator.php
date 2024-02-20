<?php

namespace Core\Form;

use Core\DB\DB;

class Validator
{
    private array $errors = [];

    public function __construct(
        private readonly array $data = []
    ) {
    }

    public function validate(array $rules): void
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

    public function applyRule(mixed $field, string $rule): void
    {
        $ruleParts = explode(':', $rule);
        $ruleName  = $ruleParts[0];
        $ruleArgs  = isset($ruleParts[1]) ? explode(',', $ruleParts[1]) : [];

        $field = $this->deleteEndString($field);

        switch ($ruleName) {
            case 'required':
                $this->required($field);
                break;
            case 'email':
                $this->email($field);
                break;
            case 'min':
                $this->min($ruleArgs[0], $field);
                break;
            case 'max':
                $this->max($ruleArgs[0], $field);
                break;
            case 'confirm':
                $this->confirm($field);
                break;
            case 'exist':
                $args = explode('.', $ruleArgs[0]);
                $this->exist($field, $args[0], $args[1]);
                break;
            case 'file':
                $this->file($field);
                break;
            case 'size':
                $this->size($field, $ruleArgs[0]);
                break;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function required(string $filed): void
    {
        // require test, int, string
        if (empty($this->data[$filed])) {
            $this->errors[$filed][] = 'Le champ est requis';
        } else {
            if (isset($this->data[$filed]['name'])) {
                if (empty($this->data[$filed]['name'][0])) {
                    $this->errors[$filed.'[]'][] = 'Le champ est requis';
                }
            }
        }
    }

    private function email(string $field): void
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Le champ doit être un email valide';
        }
    }

    private function min(string $min, string $field): void
    {
        if (strlen($this->data[$field]) < (int) $min) {
            $this->errors[$field][] = 'Le champ doit contenir au moins '.$min.' caractères';
        }
    }

    private function max(string $max, string $field): void
    {
        if (strlen($this->data[$field]) > (int) $max) {
            $this->errors[$field][] = 'Le champ doit contenir au plus '.$max.' caractères';
        }
    }

    private function confirm(string $filed): void
    {
        if ($this->data[$filed] !== $this->data[$filed.'_confirm']) {
            $this->errors[$filed] = 'Le champ '.$filed.' doit être identique au champ confirmation';
        }
    }

    private function exist(string $field, string $table, string $column): void
    {
        $db    = new DB();
        $table = config('database.prefix').'_'.$table;

        $sql = "SELECT * FROM $table WHERE $column = :$column";

        $query = $db->getPdo()->prepare($sql);
        $query->bindValue(":$column", $this->data[$field]);
        $query->execute();

        $result = $query->fetch();

        if (!$result) {
            $this->errors[$field][] = 'L\''.$field.' n\'existe pas';
        }
    }

    private function file(string $field): void
    {
        if (!is_array($this->data[$field]) || !isset($this->data[$field]['tmp_name']) && !is_uploaded_file($this->data[$field]['tmp_name'])) {
            $this->errors[$field][] = 'Le champ doit être un fichier';
        }
    }

    private function size(string $size, string $field): void
    {
        if ($this->data[$field]['size'] > (int) $size) {
            $this->errors[$field.'[]'][] = 'Le champ doit être inférieur à '.$size.' octets';
        }
    }

    private function deleteEndString(string $filed): array|string
    {
        return str_ends_with($filed, '[]') ? str_replace('[]', '', $filed) : $filed;
    }
}
