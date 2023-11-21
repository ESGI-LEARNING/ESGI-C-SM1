<?php

namespace App;

use App\Controllers\Error;
use App\Controllers\ErrorController;

class Autoloader
{
    public static function autoload($class): void
    {
        $class = str_replace("App\\","", $class);
        $class = str_replace("\\","/", $class);

        if(file_exists('../' . $class.".php")){
            include $class.".php";
        }
        else {
            $errorController = new ErrorController();
            $errorController->page404();
            echo 'La classe ' . $class . ' n\'existe pas';
        }
    }

    public static function register(): void
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}