<?php

namespace App\Controllers;

use Core\Views\View;

class MainController
{
    public function home(): void
    {
        $dbname = config('database.database');
        var_dump($dbname); die();

        $myView = new View('main/home', 'front');
    }
}
