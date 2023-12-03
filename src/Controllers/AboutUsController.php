<?php

namespace App\Controllers;

use Core\Views\View;

class AboutUsController
{
    public function aboutUs(): void
    {
        $myView = new View('main/aboutUs', 'front');
    }
}
