<?php

namespace App\Controllers;

use App\Core\Views\View;

class Error
{
    public function page404(): void
    {
        $myView = new View("error/404", "front");
    }

}