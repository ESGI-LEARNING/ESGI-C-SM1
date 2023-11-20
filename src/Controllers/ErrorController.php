<?php

namespace App\Controllers;

use App\core\Views\View;

class ErrorController
{
    public function page404(): void
    {
        $myView = new View("error/404", "front");
    }

}
