<?php

namespace Core\Form;

use App\Enum\FormTypeEnum;
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
                // regarde si le champ est un fichier
                if (isset($input['type']) && $input['type'] == 'file') {
                    if ($this->data->images === null) {
                        $this->config['inputs'][$key]['errors'][] = $validator->getErrors()[$key];
                    }
                } else {
                    $this->config['inputs'][$key]['errors'][] = $validator->getErrors()[$key];
                }
            }

            // on set data for input select
            if (isset($input['input']) && $input['input'] === FormTypeEnum::INPUT_SELECT) {
                $key                                   = str_ends_with($key, '[]') ? str_replace('[]', '', $key) : $key;
                $this->config['inputs'][$key]['value'] = $_POST[$key] ?? [];
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
