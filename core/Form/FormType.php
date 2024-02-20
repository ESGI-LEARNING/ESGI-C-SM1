<?php

namespace Core\Form;

use Core\Router\Request;
use Core\Session\CsrfTokenService;

class FormType
{
    protected array $config = [];
    protected ?object $data = null;

    private CsrfTokenService $csrfTokenService;

    private Request $request;

    public function __construct(object $data = null)
    {
        $this->data             = $data;
        $this->csrfTokenService = new CsrfTokenService();
        $this->setConfig();
        $this->request = new Request();
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
        $this->config['config']['action'] = $this->request->getUrl();
    }

    public function isSubmitted(): bool
    {
        return $this->request->getMethod() === $this->config['config']['method'] && !empty($_POST);
    }

    public function get(string $key): string|array
    {
        return $_REQUEST[$key] ?? '';
    }

    public function file(string $key): array
    {
        return $_FILES[$key];
    }

    public function isValid(): bool
    {
        $count = (count($_POST) - 2) + count($_FILES);

        if (count($this->config['inputs']) != $count) {
            return false;
        }

        // on verifie le token csrf
        if (!$this->csrfTokenService->isValidCsrfToken($_REQUEST['csrf_token'])) {
            return false;
        }

        // on fusion tout les types de données
        $data = array_merge($_POST, $_FILES);

        $validator = new Validator($data);
        $validator->validate($this->rules());

        if (count($validator->getErrors()) === 0) {
            return true;
        }

        foreach ($this->config['inputs'] as $key => $input) {
            if (!empty($validator->getErrors()[$key])) {
                $this->config['inputs'][$key]['errors'][] = $validator->getErrors()[$key];
            }

            // images edit
            if (str_contains($this->request->getUrl(), '/edit')) {
                if (isset($input['type']) && $input['type'] == 'file') {
                    if (empty($data[str_replace('[]', '', $key)]['name'][0]) && empty($this->data->images)) {
                        $this->config['inputs'][$key]['errors'] = [];

                        return true;
                    }
                }
            }

            if ($key !== 'password' && $key !== 'password_confirm') {
                $this->config['inputs'][$key]['value'] = $_REQUEST[$key] ?? '';
            }
        }

        return false;
    }

    public function pluck(array $data = null): ?array
    {
        if (empty($data)) {
            return null;
        }

        return array_map(fn ($v) => $v->getId(), $data);
    }
}
