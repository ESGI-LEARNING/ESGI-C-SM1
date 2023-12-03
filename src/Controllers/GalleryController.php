<?php

namespace App\Controllers;

use Core\Views\View;

class GalleryController
{
    public function gallery(): void
    {
        $myView = new View('main/gallery', 'front');
    }
}
