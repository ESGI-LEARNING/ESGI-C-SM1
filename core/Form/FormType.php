<?php

namespace Core\Form;

use Core\Router\Request;
use Core\Session\CsrfTokenService;

class FormType
{
    protected array $config = [];
    protected ?object $data = null;

    private CsrfTokenService $csrfTokenService;

    public function __construct(object $data = null)
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

    public function handleRequest(): void
    {
        $request = new Request();
        $this->config['config']['action'] = $request->getUrl();
    }

    public function isSubmitted(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $this->config['config']['method'] && !empty($_POST);
    }

    public function get(string $key): string
    {
        return $_REQUEST[$key] ?? '';
    }

    public function file(string $key): array
    {
        return $_FILES[$key] ?? '';
    }

    public function isValid(): bool
    {
        // on verifie que tous les champs sont remplis
        if (count($this->config['inputs']) != count($_REQUEST) - 3) {
            return false;
        }

        // on verifie le token csrf
        if (!$this->csrfTokenService->isValidCsrfToken($_REQUEST['csrf_token'])) {
            return false;
        }

        // on verifie les regles de validation
        $validator = new Validator($_REQUEST);
        $validator->validate($this->rules());

        if (count($validator->getErrors()) === 0) {
            return true;
        }

        foreach ($this->config['inputs'] as $key => $input) {
            if (!empty($validator->getErrors()[$key])) {
                $this->config['inputs'][$key]['errors'][] = $validator->getErrors()[$key];
            }

            if ($key !== 'password' && $key !== 'password_confirm') {
                $this->config['inputs'][$key]['value'] = $_REQUEST[$key] ?? '';
            }
        }

        return false;
    }
}
