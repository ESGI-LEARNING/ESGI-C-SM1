<?php

namespace App\Core\Views;

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
        if(!file_exists("../Views/templates/".$templateName.".tpl.php"))
        {
            die("Le template Views/templates/".$templateName.".tpl.php n'existe pas");
        }
        $this->templateName = "../Views/templates/".$templateName.".tpl.php";
    }

    /**
     * @param String $viewName
     */
    public function setViewName(string $viewName): void
    {
        if(!file_exists("../Views/".$viewName.".view.php"))
        {
            die("La vue Views/".$viewName.".view.php n'existe pas");
        }
        $this->viewName = "../Views/".$viewName.".view.php";
    }

    public function __destruct()
    {
        include $this->templateName;
    }
}


