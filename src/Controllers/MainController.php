<?php

namespace App\Controllers;

use Core\Views\View;

class MainController
{
    public function home(): void
    {
        $myView = new View("main/home", "front");
    }
}
