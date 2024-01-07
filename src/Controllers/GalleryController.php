<?php

namespace App\Controllers;

use Core\Controller\AbstractController;
use Core\Views\View;

class GalleryController extends AbstractController
{
    public function gallery(): View
    {
        return $this->render('main/gallery', 'front');
    }
}
