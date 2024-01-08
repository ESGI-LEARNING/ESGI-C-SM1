<?php

namespace Core\Form;

use Core\Session\CsrfTokenService;

class FormType
{
    protected array $config = [];
    protected ?object $data = null;

    private CsrfTokenService $csrfTokenService;

    public function __construct(?object $data = null)
    {
        $this->data = $data;
        $this->csrfTokenService = new CsrfTokenService();
        $this->setConfig();
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function rules(): array
    {
        return [];
    }

    public function isSubmitted(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getData(): bool|array
    {
        if (!$this->csrfTokenService->isValidCsrfToken($_POST['csrf_token'])) {
            return false;
        }

        return $_POST;
    }

    public function isValid(): bool
    {

        $validator = new Validator($this->getData());
        $validator->validate($this->rules());

        if (count($validator->getErrors()) === 0) {
            return true;
        }

        foreach ($this->config['inputs'] as $key => $input) {
            if (!empty($validator->getErrors()[$key])) {
                $this->config['inputs'][$key]['errors'][] = $validator->getErrors()[$key];
            }

            if ($key !== 'password' && $key !== 'password_confirm') {
                $this->config['inputs'][$key]['value'] = $this->getData()[$key] ?? '';
            }
        }

        return false;
    }
}
