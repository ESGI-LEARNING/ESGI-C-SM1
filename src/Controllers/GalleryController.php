<?php

namespace App\Controllers;

use App\Models\Picture;
use Core\Controller\AbstractController;
use Core\Views\View;

class GalleryController extends AbstractController
{
    public function gallery(): View
    {
        $images = new Picture();
        $images = $images::query()->with(['image'])->findAll();

        return $this->render('main/gallery', 'front', [
            'images' => $images,
        ]);
    }
}
