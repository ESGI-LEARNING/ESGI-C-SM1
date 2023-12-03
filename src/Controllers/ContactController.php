<?php

namespace App\Controllers;

use Core\Views\View;

class ContactController
{
    public function contact(): void
    {
        $myView = new View('main/contact', 'front');
    }
}
