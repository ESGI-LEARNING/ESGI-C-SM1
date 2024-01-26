<?php

namespace Core\Views;

use Core\Session\CsrfTokenService;

class View
{
    private string $templateName;
    private string $viewName;
    private array $params = [];

    protected string $csrfToken;

    public function __construct(string $viewName, string $templateName = 'back', array $params = [])
    {
        $this->csrfToken = $this->setCsrf();
        $this->setViewName($viewName);
        $this->setTemplateName($templateName);
        $this->setVariables($params);
    }

    public function setTemplateName(string $templateName): void
    {
        if (!file_exists('../views/templates/'.$templateName.'.tpl.php')) {
            exit('Le template views/templates/'.$templateName.".tpl.php n'existe pas");
        }
        $this->templateName = '../views/templates/'.$templateName.'.tpl.php';
    }

    public function setViewName(string $viewName): void
    {
        if (!file_exists('../views/'.$viewName.'.view.php')) {
            exit('La vue views/'.$viewName.".view.php n'existe pas");
        }
        $this->viewName = '../views/'.$viewName.'.view.php';
    }

    public function component(string $component, array $config, array $data = []): void
    {
        if (!file_exists('../views/components/'.$component.'.php')) {
            exit('Le composant views/components/'.$component.".php n'existe pas");
        }
        include '../views/components/'.$component.'.php';
    }

    public function setVariables(array $params): void
    {
        $this->params = $params;
    }

    public function setCsrf(): string
    {
        $csrfTokenService = new CsrfTokenService();

        return $csrfTokenService->generateToken();
    }

    public function __destruct()
    {
        extract($this->params);
        include $this->templateName;
    }

    public function envAsset(): string
    {
        $manifest = json_decode(file_get_contents(__DIR__.'/../public/build/manifest.json'), true);
        $css      = $manifest['assets/js/app.css']['file'];
        $js       = $manifest['assets/js/app.js']['file'];

        if (config('app.env') === 'dev') {
            return <<<HTML
            <script type="module" src="http://localhost:5173/assets/js/app.js"></script>
            <script type="module" src="http://localhost:5173/@vite/client"></script>
        HTML;
        }

        return <<<HTML
            <link rel="stylesheet" href="/build/{$css}">
            <script src="/build/{$js}"></script>
        HTML;
    }
}
