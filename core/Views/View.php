<?php

namespace App\core\Views;

class View
{
    private string $templateName;
    private string $viewName;

    public function __construct(string $viewName, string $templateName = "back")
    {
        $this->setViewName($viewName);
        $this->setTemplateName($templateName);
    }

    /**
     * @param String $templateName
     */
    public function setTemplateName(string $templateName): void
    {
        if(!file_exists("../views/templates/".$templateName.".tpl.php"))
        {
            die("Le template views/templates/".$templateName.".tpl.php n'existe pas");
        }
        $this->templateName = "../views/templates/".$templateName.".tpl.php";
    }

    /**
     * @param String $viewName
     */
    public function setViewName(string $viewName): void
    {
        if(!file_exists("../views/".$viewName.".view.php"))
        {
            die("La vue views/".$viewName.".view.php n'existe pas");
        }
        $this->viewName = "../views/".$viewName.".view.php";
    }

    public function __destruct()
    {
        include $this->templateName;
    }
}


