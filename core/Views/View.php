<?php

namespace Core\Views;

use Core\Session\CsrfTokenService;
use Core\Session\FlashService;

class View extends HelperView
{
    protected string $csrfToken;
    private string $templateName;
    private string $viewName;
    private array $params = [];

    public function __construct(string $viewName, string $templateName = 'back', array $params = [])
    {
        $this->csrfToken = $this->setCsrf();
        $this->setViewName($viewName);
        $this->setTemplateName($templateName);
        $this->setVariables($params);
    }

    public function setCsrf(): string
    {
        $csrfTokenService = new CsrfTokenService();

        return $csrfTokenService->generateToken();
    }

    public function setViewName(string $viewName): void
    {
        if (!file_exists('../views/'.$viewName.'.view.php')) {
            exit('La vue views/'.$viewName.".view.php n'existe pas");
        }
        $this->viewName = '../views/'.$viewName.'.view.php';
    }

    public function setTemplateName(string $templateName): void
    {
        if (!file_exists('../views/templates/'.$templateName.'.tpl.php')) {
            exit('Le template views/templates/'.$templateName.".tpl.php n'existe pas");
        }
        $this->templateName = '../views/templates/'.$templateName.'.tpl.php';
    }

    public function setVariables(array $params): void
    {
        $this->params = $params;
    }

    public function component(string $component, array $config, array $data = []): void
    {
        if (!file_exists('../views/components/'.$component.'.php')) {
            exit('Le composant views/components/'.$component.".php n'existe pas");
        }
        include '../views/components/'.$component.'.php';
    }

    public function flash(): array
    {
        $service = new FlashService();
        $service->getFlash('success');

        if (!empty($service->getMessage())) {
            return $service->getMessage();
        }

        return [];
    }

    public function __destruct()
    {
        extract($this->params);
        include $this->templateName;
    }

    CONST DEFAULT_NAMESPACE = '__MAIN';

    private array $paths = [];

    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    public function render(string $view, array $params = []): string
    {

        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) . '.php';
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';

            if (!file_exists($path)) {
                throw new \Exception('La vue '.$view.' n\'existe pas');
            }
        }

        ob_start();
        extract($params);
        include $view;

        return ob_get_clean();
    }

    private function hasNamespace(string $view): bool
    {
        return $view[0] === '@';
    }

    private function getNamespace(string $view): string
    {
        return substr($view, 1, strpos($view, '/') - 1);
    }

    private function replaceNamespace(string $view): string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@'.$namespace, $this->paths[$namespace], $view);
    }
}
