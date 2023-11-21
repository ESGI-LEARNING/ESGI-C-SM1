<?php

namespace App\Controllers;

use App\core\Views\View;

class MainController
{
    public function home()
    {
        $myView = new View("main/home", "front");
    }
    public function aboutUs()
    {
        $myView = new View("main/aboutus", "front");
    }
    public function contact()
    {
        $myView = new View("main/contact", "front");
    }
    public function gallery()
    {
        $myView = new View("main/gallery", "front");
    }
}
