<?php

namespace Core\Views;

use Core\Router\Router;

class View
{
    private string $templateName;
    private string $viewName;
    private array $params = [];

    public function __construct(string $viewName, string $templateName = 'back', array $params = [])
    {
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
        if(!file_exists("../views/components/".$component.".php"))
        {
            die("Le composant views/components/".$component.".php n'existe pas");
        }
        include "../views/components/".$component.".php";
    }

    public function path(string $path): string
    {
        return Router::getInstance()->path($path);
    }

    public function setVariables(array $params): void
    {
        $this->params = $params;
    }

    public function __destruct()
    {
        extract($this->params);
        include $this->templateName;
    }
}
