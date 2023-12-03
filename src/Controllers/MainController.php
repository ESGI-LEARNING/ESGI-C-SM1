<?php

namespace App\Controllers;

use Core\Views\View;

class MainController
{
    public function home(): void
    {
        $myView = new View('main/home', 'front');
    }

    public function contact(): void
    {
        $myView = new View('main/contact', 'front');
    }

    public function aboutUs(): void
    {
        $myView = new View('main/aboutUs', 'front');
    }

    public function gallery(): void
    {
        $myView = new View('main/gallery', 'front');
    }
}
