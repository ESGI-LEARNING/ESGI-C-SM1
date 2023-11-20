<?php
namespace App;

use App\Controllers\Error;

class Autoloader
{
    public static function autoload($class): void
    {
        $class = str_replace("App\\","", $class);
        $class = str_replace("\\","/", $class);

        if(file_exists('../' . $class.".php")){
            include $class.".php";
        }
    }

    public static function register(): void
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}