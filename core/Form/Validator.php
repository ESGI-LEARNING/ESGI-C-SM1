<?php

namespace Core\Form;

use Core\DB\DB;

class Validator
{
    private array $errors = [];

    public function __construct(
        private readonly array $data = []
    )
    {
    }

    public function validate(array $rules): void
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

    public function applyRule(mixed $field, $rule): void
    {
        $ruleParts = explode(':', $rule);
        $ruleName = $ruleParts[0];
        $ruleArgs = isset($ruleParts[1]) ? explode(',', $ruleParts[1]) : [];

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
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function required(string $filed): void
    {
        if (empty($this->data[$filed])) {
            $this->errors[$filed][] = 'Le champ est requis';
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
        if (strlen($this->data[$field]) < (int)$min) {
            $this->errors[$field][] = 'Le champ doit contenir au moins ' . $min . ' caractères';
        }
    }

    private function max(string $max, string $field): void
    {
        if (strlen($this->data[$field]) > (int)$max) {
            $this->errors[$field][] = 'Le champ doit contenir au plus ' . $max . ' caractères';
        }
    }

    private function confirm(string $filed): void
    {
        if ($this->data[$filed] !== $this->data[$filed . '_confirm']) {
            $this->errors[$filed] = 'Le champ ' . $filed . ' doit être identique au champ confirmation';
        }
    }

    private function unique(string $field): void
    {
        // TODO: create unique validation
    }

    private function exist(string $field, string $table, string $column): void
    {
        $db = new DB();
        $table = config('database.prefix') . '_' . $table;

        $sql = "SELECT * FROM $table WHERE $column = :$column";

        $query = $db->getPdo()->prepare($sql);
        $query->bindValue(":$column", $this->data[$field]);
        $query->execute();

        $result = $query->fetch();

        if (!$result) {
            $this->errors[$field][] = 'L\'' . $field . ' n\'existe pas';
        }
    }
}
